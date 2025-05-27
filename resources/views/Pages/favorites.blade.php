<x-app-layout>
    @php
        $columns = [
            ['label' => 'ID', 'key' => 'favorite_id'],
            ['label' => 'Name', 'key' => 'name_user'],
            ['label' => 'Rol', 'key' => 'role'],
            ['label' => 'Name place', 'key' => 'name_place'],
            ['label' => 'Added date', 'key' => 'added_date'],
        ];
    @endphp
    <div id="table-container">
        <x-general-table :columns="$columns" :data="$data" resource="{{ $resource }}"
            class="shadow-lg rounded-lg overflow-hidden" />
    </div>
</x-app-layout>
