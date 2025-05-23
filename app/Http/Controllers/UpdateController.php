<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
  // Método para procesar la actualización
    public function update(Request $request, $resource, $id)
    {
        $map = $this->getResourceMap();
        if (!isset($map[$resource])) {
            abort(404);
        }
        // Obtener el registro original desde la API
        $apiUrl = env('API_TURISMO_URL') . '/' . $map[$resource] . '/' . $id;
        $response = Http::withoutVerifying()->get($apiUrl);
        if (!$response->successful()) {
            return back()->withErrors(['error' => 'No se pudo obtener el recurso.']);
        }
        $originalData = $response->json();
        $original = is_array($originalData) && count($originalData) === 1 ? $originalData[0] : $originalData;
        // Obtener datos del formulario, asignar valores originales a los campos vacíos
        $data = collect($request->except(['_token', '_method']))
            ->mapWithKeys(function ($value, $key) use ($original) {
                return [$key => ($value === null || $value === '') && isset($original[$key]) ? $original[$key] : $value];
            })->toArray();
        logger('Datos enviados al API:', $data);
        // Detectar si hay cambios reales
        $hayCambios = collect($data)->some(function ($nuevoValor, $key) use ($original) {
            if (!array_key_exists($key, $original)) return false;
            if ($key === 'password' && !empty($nuevoValor)) return true;
            return $original[$key] != $nuevoValor;
        });
        if (!$hayCambios) {
            return back()->withErrors(['error' => 'No se realizaron cambios en el formulario.']);
        }
        // Enviar actualización a la API
        $putResponse = Http::withoutVerifying()->put($apiUrl, $data);
        logger('Respuesta API:', ['status' => $putResponse->status(), 'body' => $putResponse->body()]);
        if (!$putResponse->successful()) {
            return back()->withErrors(['error' => 'Error al actualizar el recurso.']);
        }
        return redirect($resource)->with('success', 'Registro actualizado correctamente.');
    }
}