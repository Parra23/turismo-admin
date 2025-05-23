@php
    $currentUserId = Auth::id(); // ID del usuario autenticado
@endphp

<div id="table-container">
   @include('components.partials.table-content', [
    'data' => $data,
    'columns' => $columns,
    'resource' => $resource,
    'currentUserId' => Auth::id(),
])
</div>