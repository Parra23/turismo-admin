<x-app-layout>
    <div id="table-container">
        <x-general-table :columns="$columns" 
        :data="$data" 
        resource="{{ $resource }}"
        class="shadow-lg rounded-lg overflow-hidden" />
    </div>
</x-app-layout>

