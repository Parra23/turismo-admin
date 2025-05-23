<x-app-layout>
    @php
        $columns = [
            ['label' => 'ID', 'key' => 'id'],
            ['label' => 'Name', 'key' => 'name_city'],
            ['label' => 'Department', 'key' => 'name_department'],
        ];
    @endphp

    <div id="table-container">
        <x-general-table 
            :columns="$columns" 
            :data="$data" 
            resource="{{ $resource }}" 
            class="shadow-lg rounded-lg overflow-hidden" 
        />
    </div>
</x-app-layout>
