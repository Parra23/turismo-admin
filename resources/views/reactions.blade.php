<x-app-layout>
    @php
        $columns = [
            ['label' => 'ID', 'key' => 'reaction_id'],
            ['label' => 'User name', 'key' => 'name_user'],
            ['label' => 'Place name', 'key' => 'name_place'],
            ['label' => 'Reaction type', 'key' => 'reaction_type'],
            ['label' => 'Reaction date', 'key' => 'reaction_date'],
        ];
    @endphp
    <div id="table-container">
        <x-general-table :columns="$columns" :data="$data" resource="{{ $resource }}"
            class="shadow-lg rounded-lg overflow-hidden" />
    </div>
</x-app-layout>
