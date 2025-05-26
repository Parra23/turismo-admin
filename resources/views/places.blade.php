<x-app-layout>
    @php
        $columns = [
            ['label' => 'ID', 'key' => 'place_id'],
            ['label' => 'Place name', 'key' => 'name'],
            ['label' => 'Type', 'key' => 'name_type'],
            ['label' => 'Description', 'key' => 'description'],
            ['label' => 'Address', 'key' => 'address'],
            ['label' => 'City', 'key' => 'name_city'],
            ['label' => 'Contact Phone', 'key' => 'contact_phone'],
            ['label' => 'Contact Email', 'key' => 'contact_email'],
            ['label' => 'Contact Website', 'key' => 'social_media'],
            ['label' => 'Fees', 'key' => 'fees'],
            ['label' => 'Status', 'key' => 'status'],
            ['label' => 'Creation date', 'key' => 'creation_date'],
            
        ];
    @endphp
    <div id="table-container">
        <x-general-table :columns="$columns" :data="$data" resource="{{ $resource }}"
            class="shadow-lg rounded-lg overflow-hidden" />
    </div>
</x-app-layout>
