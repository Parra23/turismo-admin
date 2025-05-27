<x-app-layout>
    @php
        $columns = [
            ['label' => 'ID', 'key' => 'id'],
            ['label' => 'Name', 'key' => 'user_name'],
            ['label' => 'Table name', 'key' => 'table_name'],
            ['label' => 'Action type', 'key' => 'action_type'],
            ['label' => 'Description', 'key' => 'description'],
            ['label' => 'Action timestamp', 'key' => 'action_timestamp'],
            
        ];
    @endphp
    <div id="table-container">
        <x-general-table :columns="$columns" :data="$data" resource="{{ $resource }}"
            class="shadow-lg rounded-lg overflow-hidden" />
    </div>
</x-app-layout>
