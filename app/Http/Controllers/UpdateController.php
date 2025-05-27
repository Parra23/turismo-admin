<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function update(Request $request, $resource, $id)
    {
        $map = $this->getResourceMap();
        if (!isset($map[$resource])) {
            $msg = 'Recurso no válido.';
            abort(404, $msg);
        }

        $apiUrl = rtrim(env('API_TURISMO_URL'), '/') . '/' . $map[$resource] . '/' . $id;
        $original = Http::withoutVerifying()->get($apiUrl)->json();
        if (!$original) {
            $msg = 'No se pudo obtener el recurso.';
            return back()->withErrors(['error' => $msg]);
        }
        if (is_array($original) && count($original) === 1) $original = $original[0];

        $data = collect($request->except(['_token', '_method']))
            ->map(fn($v, $k) => ($v === null || $v === '') && isset($original[$k]) ? $original[$k] : $v)
            ->toArray();

        if (isset($data['role']))   $data['role']   = $data['role'] === 'admin' ? 1 : 0;
        if (isset($data['status'])) $data['status'] = $data['status'] === 'active' ? 1 : 0;

        if (!collect($data)->some(fn($v, $k) => (array_key_exists($k, $original) && ($k === 'password' ? !empty($v) : $original[$k] != $v)))) {
            $msg = 'No se realizaron cambios en el formulario.';
            return back()->withErrors(['error' => $msg]);
        }

        $response = Http::withoutVerifying()->put($apiUrl, $data);
        logger('Respuesta API:', ['status' => $response->status(), 'body' => $response->body(), 'data_enviada' => $data]);

        if (!$response->successful()) {
            $msg = 'Error al actualizar el recurso.';
            $apiError = null;
            // Intenta decodificar solo si es JSON
            if (str_contains($response->header('Content-Type'), 'application/json')) {
                $apiError = $response->json();
                $msg = $apiError['error'] ?? $apiError['message'] ?? $msg;
            }
            return back()->withErrors(['error' => $msg]);
        }

        return redirect($resource)->with('success', 'Updated registration correctly.');
    }
}