<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;

abstract class Controller
{
    protected static $resourceMap = [
        'users'        => 'vw_user',
        'departments' => 'Departments',
        'depts'        => 'Departments',
        'cities'       => 'Cities',
        'placetypes'     => 'PlaceTypes',
        'photos'       => 'Photos',
        'comments'     => 'Comments',
        'logs'       => 'vw_logs',
        'favorites'     => 'Favorites',
        'places' => 'Places',
        'reactions' => 'Reactions',
    ];
    protected function getResourceMap()
    {
        return self::$resourceMap;
    }
    public function paginateArray($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: Paginator::resolveCurrentPage();

        $itemsCollection = collect($items);

        $paginatedItems = new LengthAwarePaginator(
            $itemsCollection->forPage($page, $perPage),
            $itemsCollection->count(),
            $perPage,
            $page,
            $options
        );

        $paginatedItems->withPath(request()->url());

        return $paginatedItems;
    }

    protected function filterDataArray(array $dataArray, ?string $search): array
    {
        if (!$search) return $dataArray;

        $search = trim($search);
        return array_values(array_filter($dataArray, function ($item) use ($search) {
            foreach ($item as $key => $value) {
                $valueStr = is_null($value) ? '' : (string)$value;
                // Búsqueda general (contiene)
                if (stripos($valueStr, $search) !== false) return true;
                // Búsqueda especial para "role"
                if ($key === 'role') {
                    $roleText = $value == 1 ? 'Admin' : 'User';
                    if (
                        strcasecmp($roleText, $search) === 0 ||
                        (string)$value === $search
                    ) return true;
                }
                // Búsqueda especial para "status"
                if ($key === 'status') {
                    $statusText = $value == 1 ? 'Active' : 'Inactive';
                    if (
                        strcasecmp($statusText, $search) === 0 ||
                        (string)$value === $search
                    ) return true;
                }
            }
            return false;
        }));
    }
    public function options()
    {
        $departments = Http::withoutVerifying()->get(env('API_TURISMO_URL') . '/departments')->json();
        $users = Http::withoutVerifying()->get(env('API_TURISMO_URL') . '/vw_user')->json();
        $places = Http::withoutVerifying()->get(env('API_TURISMO_URL') . '/Places')->json();
        $placetypes = Http::withoutVerifying()->get(env('API_TURISMO_URL') . '/PlaceTypes')->json();
        $city = Http::withoutVerifying()->get(env('API_TURISMO_URL') . '/Cities')->json();
        $comment = Http::withoutVerifying()->get(env('API_TURISMO_URL') . '/Comments')->json();

        $departments = $departments['data'] ?? $departments ?? [];
        $users = $users['data'] ?? $users ?? [];
        $places = $places['data'] ?? $places ?? [];
        $placetypes = $placetypes['data'] ?? $placetypes ?? [];
        $city = $city['data'] ?? $city ?? [];
        $comment = $comment['data'] ?? $comment ?? [];

        //dd($comment);
        //dd($places );
        foreach ($users as &$user) {
            $user['role_name'] = $user['role'] == 1 ? 'admin' : 'user';
            $user['status_name'] = $user['status'] == 1 ? 'active' : 'inactive';
        }

        return [
            'department_id' => collect($departments)->pluck('name', 'id')->toArray(),
            'id'       => collect($users)->pluck('name', 'id')->toArray(),
            'user_id'  => collect($users)->pluck('name', 'id')->toArray(),
            'role'   => collect($users)->pluck('role_name')->unique()->mapWithKeys(fn($v) => [$v => ucfirst($v)])->toArray(),
            'status' => collect($users)->pluck('status_name')->unique()->mapWithKeys(fn($v) => [$v => ucfirst($v)])->toArray(),
            'place_id'      => collect($places)->pluck('name', 'place_id')->toArray(),
            'type_id' => collect($placetypes)->pluck('name', 'id')->toArray(),
            'city_id' => collect($city)->pluck('name_city', 'id')->toArray(),
            'parent_comment_id' => collect($comment)
                ->pluck('comment', 'comment_id')
                ->toArray(),
        ];
    }
}
