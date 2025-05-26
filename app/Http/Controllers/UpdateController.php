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
        abort(404, 'Recurso no válido.');
    }

    $apiUrl = rtrim(env('API_TURISMO_URL'), '/') . '/' . $map[$resource] . '/' . $id;

    $original = Http::withoutVerifying()->get($apiUrl)->json();
    if (!$original) {
        return back()->withErrors(['error' => 'No se pudo obtener el recurso.']);
    }

    // Si la API devuelve un array de un solo registro
    if (is_array($original) && count($original) === 1) {
        $original = $original[0];
    }

    // Datos del formulario, manteniendo valores originales si vienen vacíos
    $data = collect($request->except(['_token', '_method']))
        ->map(fn($value, $key) => $this->getUpdatedValue($value, $original, $key))
        ->toArray();

    // Verificar si hubo algún cambio
    if (!$this->hayCambios($original, $data)) {
        return back()->withErrors(['error' => 'No se realizaron cambios en el formulario.']);
    }

    $response = Http::withoutVerifying()->put($apiUrl, $data);
    logger('Respuesta API:', ['status' => $response->status(), 'body' => $response->body()]);

    if (!$response->successful()) {
        return back()->withErrors(['error' => 'Error al actualizar el recurso.']);
    }

    return redirect($resource)->with('success', 'Registro actualizado correctamente.');
}

private function getUpdatedValue($value, $original, $key)
{
    return ($value === null || $value === '') && isset($original[$key])
        ? $original[$key]
        : $value;
}

private function hayCambios(array $original, array $data)
{
    return collect($data)->some(function ($nuevoValor, $key) use ($original) {
        if (!array_key_exists($key, $original)) return false;
        if ($key === 'password' && !empty($nuevoValor)) return true;
        return $original[$key] != $nuevoValor;
    });
}

}