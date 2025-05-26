<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

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
}
