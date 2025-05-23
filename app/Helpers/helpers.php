<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

if (!function_exists('paginateArray')) {
    function paginateArray($items, $perPage = 10, $page = null, $options = [])
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
        return $paginatedItems;
    }
}
