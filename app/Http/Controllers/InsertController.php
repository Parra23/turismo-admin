<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class InsertController extends Controller
{
    // Método para procesar la inserción
    public function insert($resource)
    {
        $map = $this->getResourceMap();
        $apiUrl  = env(key: 'API_TURISMO_URL') . '/' . $map[$resource];
        $response = Http::withoutVerifying()->get($apiUrl);
        if (!$response->successful()) {
            abort(404);
        }
        $data = $response->json();
        // dd($data);
        if (empty($data)) {
            abort(404, 'Registro no encontrado');
        }
        $registro = $data[0];
        $fields = array_keys($registro);
        return view('components.general-insert', compact('fields', 'resource'));
    }
    public function store(\Illuminate\Http\Request $request, $resource)
    {
        $map = $this->getResourceMap();
        if (!isset($map[$resource])) {
            abort(404);
        }

        $apiUrl = env('API_TURISMO_URL') . '/' . $map[$resource];
        $data = $request->except('_token');

        $response = Http::withoutVerifying()->post($apiUrl, $data);

        if (!$response->successful()) {
            $errorData = $response->json() ?? ['error' => 'No se pudo crear el registro.'];
            if ($request->ajax()) {
                // Devuelve toda la respuesta de la API
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
