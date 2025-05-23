<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowController extends Controller
{
    public function show(Request $request, $resource)
    {
        $map = $this->getResourceMap();
        if (!isset($map[$resource])) {
            abort(404);
        }
        $apiUrl  = env('API_TURISMO_URL') . '/' . $map[$resource];
        $response = Http::withoutVerifying()->get($apiUrl);
        if (!$response->successful()) {
            abort(404, 'Error al obtener los registros');
        }
        $dataArray = $response->json();
        if (empty($dataArray)) {
            abort(404, 'Registro no encontrado');
        }
        $dataArray = $this->filterDataArray($dataArray, $request->get('search'));
        $exclude = ['password'];
        $columns = [];

        // Detecta el campo identificador si no existe 'id'
        if (count($dataArray) > 0 && !isset($dataArray[0]['id'])) {
            $possibleIds = ['photo_id', 'user_id', 'dept_id', 'place_id'];
            foreach ($possibleIds as $pid) {
                if (isset($dataArray[0][$pid])) {
                    foreach ($dataArray as &$item) {
                        $item['id'] = $item[$pid];
                    }
                    unset($item);
                    break;
                }
            }
        }
        $exclude = ['password'];
        $columns = [];
        if (count($dataArray) > 0) {
            $columns = collect($dataArray[0])
                ->keys()
                ->reject(fn($key) => in_array($key, $exclude))
                ->map(fn($key) => [
                    'key' => $key,
                    'label' => ucfirst(str_replace('_', ' ', $key)),
                ])
                ->toArray();
        }
        // ORDENAMIENTO
        $sort = $request->get('sort');
        $direction = $request->get('direction', 'asc');
        $items = collect($dataArray);
        if ($sort && isset($dataArray[0][$sort])) {
            $items = $items->sortBy($sort, SORT_REGULAR, $direction === 'desc');
        }
        // PAGINACIÓN
        $page = $request->get('page', 1);
        $perPage = 10;
        $total = $items->count();
        $results = $items->slice(($page - 1) * $perPage, $perPage)->values();
        $data = new LengthAwarePaginator(
            $results,
            $total,
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
        if ($request->ajax()) {
            $view = view('components.general-table', [
                'data' => $data,
                'columns' => $columns,
                'resource' => $resource,
            ])->render();

            // dd($view); // Esto muestra el HTML que se va a enviar al front
        }

        // RESPUESTA NORMAL (layout completo)
        return view("$resource", [
            'data' => $data,
            'resource' => $resource,
        ]);
    }
    public function showOne($resource, $id)
    {
        return redirect()->route('general.show', ['resource' => $resource]);
    }
}
