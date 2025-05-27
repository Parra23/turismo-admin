<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Support\Columns;

class ShowController extends Controller
{
    public function show(Request $request, $resource)
    {
        $map = $this->getResourceMap();
        if (!isset($map[$resource])) abort(404);

        $apiUrl = env('API_TURISMO_URL') . '/' . $map[$resource];
        $response = Http::withoutVerifying()->get($apiUrl);
        if (!$response->successful()) abort(404, 'Error al obtener los registros');

        $dataArray = $this->filterDataArray($response->json() ?? [], $request->get('search'));
        if (empty($dataArray)) abort(404, 'Registro no encontrado');

        // Asegura que cada registro tenga un campo 'id'
        if (!isset($dataArray[0]['id'])) {
            foreach (['photo_id', 'user_id', 'dept_id', 'place_id'] as $pid) {
                if (isset($dataArray[0][$pid])) {
                    foreach ($dataArray as &$item) $item['id'] = $item[$pid];
                    unset($item);
                    break;
                }
            }
        }

        // Ordenamiento y paginación
        $items = collect($dataArray);
        $sort = $request->get('sort');
        $direction = $request->get('direction', 'asc');
        if ($sort && isset($dataArray[0][$sort])) {
            $items = $items->sortBy($sort, SORT_REGULAR, $direction === 'desc');
        }
        $perPage = 10;
        $page = $request->get('page', 1);
        $data = new LengthAwarePaginator(
            $items->slice(($page - 1) * $perPage, $perPage)->values(),
            $items->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

    $columns = Columns::get($resource); // <-- AQUÍ

        return view("Pages.$resource", [
            'data' => $data,
            'resource' => $resource,
            'columns' => $columns,
        ]);
    }

    public function showOne($resource, $id)
    {
        return redirect()->route('general.show', ['resource' => $resource]);
    }
}
