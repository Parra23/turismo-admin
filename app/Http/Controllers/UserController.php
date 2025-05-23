<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $apiUrl = env('API_TURISMO_URL') . '/vw_user';
        $response = Http::withoutVerifying()->get($apiUrl);

        if ($response->successful()) {
            $usuariosArray = $response->json();
            $page = $request->get('page', 1);
            $usuarios = $this->paginateArray($usuariosArray, 10, $page);
            // Excluir 'password' de las columnas
            $exclude = ['password'];

            // Si no hay registros, columnas vacías
            if (count($usuariosArray) > 0) {
                $columns = collect($usuariosArray[0])
                    ->keys()
                    ->reject(fn($key) => in_array($key, $exclude))
                    ->map(fn($key) => [
                        'key' => $key,
                        'label' => ucfirst(str_replace('_', ' ', $key)),
                    ])
                    ->toArray();
            } else {
                $columns = [];
            }

        return view('users', compact('usuarios', 'columns'));
        } else {
            abort(500, 'Error al obtener datos de la API');
        }
    }
}
