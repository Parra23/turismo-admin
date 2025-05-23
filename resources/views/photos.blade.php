<x-app-layout>
    @php
        $columns = [
            ['label' => 'Photo ID', 'key' => 'photo_id'],
            // ['label' => 'Place ID', 'key' => 'place_id'],
            ['label' => 'Url', 'key' => 'url'],
            ['label' => 'Description', 'key' => 'description'],
        ];
    @endphp
    <div id="table-container">
        <x-general-table :columns="$columns" :data="$data" resource="{{ $resource }}"
            class="shadow-lg rounded-lg overflow-hidden" />
    </div>
</x-app-layout>
