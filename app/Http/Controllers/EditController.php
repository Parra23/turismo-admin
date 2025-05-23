<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
class EditController extends Controller
{
  
    // Método para procesar la edición
    public function edit($resource, $id)
    {

        $map = $this->getResourceMap();
        if (! isset($map[$resource])) {
            abort(404);
        }
        $apiUrl  = env(key: 'API_TURISMO_URL') . '/' . $map[$resource] . '/' . $id;
        $response = Http::withoutVerifying()->get($apiUrl);
        if (! $response->successful()) {
            abort(404);
        }
        $data = $response->json();
        // dd($data);
        if (empty($data)) {
            abort(404, 'Registro no encontrado');
        }
        $registro = $data[0];
    return view('edit', compact('registro', 'resource'));
    }
}