<x-app-layout>
    @php
        $columns = [
            ['label' => 'ID', 'key' => 'id'],
            ['label' => 'Name', 'key' => 'name'],
            ['label' => 'Email', 'key' => 'email'],
            ['label' => 'Rol', 'key' => 'role'],
            ['label' => 'Status', 'key' => 'status'],
            ['label' => 'Creation Date', 'key' => 'created_at'],
        ];
    @endphp
    <div id="table-container">
        <x-general-table :columns="$columns" :data="$data" resource="{{ $resource }}"
            class="shadow-lg rounded-lg overflow-hidden" />
    </div>
</x-app-layout>
