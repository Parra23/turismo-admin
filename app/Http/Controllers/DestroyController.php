<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DestroyController extends Controller
{
    public function destroy(Request $request, $resource, $id)
    {
        $map = $this->getResourceMap();
        if (!isset($map[$resource])) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Recurso no encontrado.'], 404);
            }
            abort(404);
        }

        $apiUrl  = env('API_TURISMO_URL') . '/' . $map[$resource] . '/' . $id;
        $response = Http::withoutVerifying()->delete($apiUrl);
        if (!$response->successful()) {
            $errorData = $response->json() ?? ['error' => 'No se pudo eliminar el registro.'];
            if ($request->ajax()) {
                // Devuelve toda la respuesta de la API
                return response()->json($errorData, 400);
            }
            // Si no es AJAX, usa el mensaje si existe, si no un mensaje genérico
            $errorMsg = $errorData['message'] ?? 'No se pudo eliminar el registro.';
            return redirect()
                ->route('general.show', ['resource' => $resource])
                ->with('error', $errorMsg);
        }
        if ($request->ajax()) {
            return response()->json(['success' => 'Registro eliminado correctamente']);
        }
        return redirect()
            ->route('general.show', ['resource' => $resource])
            ->with('success', 'Registro eliminado correctamente');
    }
}
