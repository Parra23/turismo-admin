<x-app-layout>
    @php
        if (empty($columns)) {
            $columns = [['label' => 'ID', 'key' => 'id'], ['label' => 'Name', 'key' => 'name']];
        }
    @endphp
    <div id="table-container">
        <x-general-table :columns="$columns" :data="$data" resource="{{ $resource }}"
            class="shadow-lg rounded-lg overflow-hidden" />
    </div>
</x-app-layout>
