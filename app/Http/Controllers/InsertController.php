<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class InsertController extends Controller
{
    // Método para procesar la inserción
    public function insert($resource)
    {
        $map = $this->getResourceMap();
        $apiUrl  = env('API_TURISMO_URL') . '/' . $map[$resource];
        $response = Http::withoutVerifying()->get($apiUrl);
        if (!$response->successful()) {
            abort(404);
        }
        $data = $response->json();
        if (empty($data)) {
            abort(404, 'Registro no encontrado');
        }
        $registro = $data[0];
        $fields = array_keys($registro);

        // Llama a la función options() para los combos
        $selectOptions = $this->options();
        // dd($selectOptions);

        return view('components.general-insert', compact('fields', 'resource', 'selectOptions'));    }
    public function store(\Illuminate\Http\Request $request, $resource)
    {
        $map = $this->getResourceMap();
        if (!isset($map[$resource])) {
            abort(404);
        }

        $apiUrl = env('API_TURISMO_URL') . '/' . $map[$resource];
        $data = $request->except('_token');

        // Mapeo de valores legibles a valores esperados por la API
        if (isset($data['role'])) {
            $data['role'] = $data['role'] === 'admin' ? 1 : 0;
        }
        if (isset($data['status'])) {
            $data['status'] = $data['status'] === 'active' ? 1 : 0;
        }

        $response = Http::withoutVerifying()->post($apiUrl, $data);

        if (!$response->successful()) {
            $errorData = $response->json() ?? ['error' => 'No se pudo crear el registro.'];
            if ($request->ajax()) {
                return response()->json($errorData, 400);
            }
            $errorMsg = $errorData['message'] ?? 'No se pudo crear el registro.';
            return redirect()
                ->route('general.insert', ['resource' => $resource])
                ->withInput()
                ->with('error', $errorMsg);
        }
        if ($request->ajax()) {
            return response()->json(['success' => 'Record created correctly']);
        }
        return redirect()
            ->route('general.show', ['resource' => $resource])
            ->with('success', 'Registro creado correctamente');
    }
}
