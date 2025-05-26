<x-app-layout>
    @php
        $columns = [
            ['label' => 'Comment ID', 'key' => 'comment_id'],
            ['label' => 'Name', 'key' => 'name_city'],
            ['label' => 'Comment', 'key' => 'comment'],
            ['label' => 'Comment Date', 'key' => 'comment_date'], 
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