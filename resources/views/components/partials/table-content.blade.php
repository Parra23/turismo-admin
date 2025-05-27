{{-- filepath: resources/views/components/partials/table-content.blade.php --}}
@php
    // Excluir columnas por key o por label
    $tableColumns = collect($columns)
        ->filter(function($col) {
            return is_array($col)
                && !in_array($col['label'] ?? '', ['Password', 'Name Department', 'name type', 'name city', 'Place ID', 'PLaCe NaMe', 'user name']);
        })
        ->values()
        ->all();
@endphp 

<div class="flex flex-col gap-4 md:flex-row md:justify-between md:items-center mb-6 max-w-5xl mx-auto">
    <div class="flex-1">
        <h1 class="text-2xl md:text-4xl font-bold text-[#023E8A] mb-2 pb-2">
            List {{ Str::singular($resource) }}
        </h1>
    </div>
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
        <!-- Buscador AJAX Mejorado -->
        <form id="ajax-search-form" class="flex items-center bg-white rounded shadow w-full sm:w-auto" autocomplete="off">
            <span class="pl-3 text-[#023E8A]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" />
                </svg>
            </span>
            <input type="text" name="search" id="search-input" value="{{ request('search') }}"
                placeholder="Search..." style="max-width: 200px; width: 160px;"
                class="px-4 py-2 border-0 focus:ring-0 focus:outline-none" aria-label="Search" />
            @if (request('search'))
                <button type="button" id="clear-search"
                    class="px-2 text-gray-400 hover:text-red-500 focus:outline-none" title="Limpiar búsqueda">
                    &times;
                </button>
            @endif
            <button type="submit"
                class="px-4 py-2 bg-[#023E8A] text-white rounded-r-md hover:bg-[#0353A4] transition font-semibold">
                Buscar
            </button>
        </form>
        @if ($resource !== 'logs')
        <a href="{{ route('general.insert', ['resource' => $resource]) }}"
            class="inline-flex justify-center items-center px-4 py-2 bg-[#FFD60A] text-[#023E8A] font-semibold rounded hover:bg-[#ffc300] transition-colors shadow w-full sm:w-auto">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            <span class="truncate">New {{ Str::singular($resource) }}</span>
        </a>
        @endif
    </div>
</div>
<div class="w-full max-w-5xl mx-auto rounded-lg shadow-lg">
    <div class="overflow-x-auto max-w-full w-full">
        <table class="min-w-full text-sm text-left divide-y divide-gray-200">
            @php
                $currentSort = explode(',', request('sort', ''));
                $currentDirection = explode(',', request('direction', ''));
            @endphp
            <thead class="bg-[#023E8A] text-white font-semibold sticky top-0">
                <tr>
                    @foreach ($tableColumns as $col)
                        @php
                            $index = array_search($col['key'], $currentSort);
                            $isSorted = $index !== false;
                            $dir = $isSorted ? $currentDirection[$index] : 'asc';
                            $nextDirection = $dir === 'asc' ? 'desc' : 'asc';
                        @endphp
                        <th scope="col" class="px-4 py-3 uppercase tracking-wide cursor-pointer whitespace-nowrap">
                            <a href="#" class="flex items-center gap-1 sort-link" data-sort="{{ $col['key'] }}"
                                data-direction="{{ $nextDirection }}">
                                {{ $col['label'] }}
                                @if ($isSorted)
                                    @if ($dir === 'asc')
                                        <svg class="w-3 h-3 inline" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M5 15l7-7 7 7" />
                                        </svg>
                                    @else
                                        <svg class="w-3 h-3 inline" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M19 9l-7 7-7-7" />
                                        </svg>
                                    @endif
                                @endif
                            </a>
                        </th>
                    @endforeach
                    <th class="px-4 py-3 uppercase tracking-wide whitespace-nowrap">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse ($data as $item)
                    @php
                        $isOwnRecord =
                            $item['id'] == $currentUserId &&
                            data_get($item, 'role') == 1 &&
                            data_get($item, 'status') == 1;
                    @endphp
                    <tr
                        @unless ($isOwnRecord || $resource === 'logs' || $resource === 'favorites')
                            onclick="window.location='{{ route('general.edit', ['resource' => $resource, 'id' => $item['id']]) }}'"
                        @endunless
                        class="relative cursor-pointer hover:bg-[#FFD60A] transition-all duration-500 ease-in-out {{ $isOwnRecord || $resource === 'logs' || $resource === 'favorites' ? 'opacity-50 cursor-not-allowed' : '' }} hover:shadow-2xl hover:-translate-y-2 hover:z-30"
                        style="will-change: transform; overflow-anchor: none;" tabindex="0"
                        @unless ($isOwnRecord || $resource === 'logs' || $resource === 'favorites')
                            onkeydown="if(event.key === 'Enter' || event.key === ' ') selectRow(this)"
                        @endunless
                    >
                        @foreach ($tableColumns as $col)
                            <td class="px-4 py-4 whitespace-nowrap text-[#023E8A]">
                                @if ($col['key'] === 'role')
                                    {{ data_get($item, $col['key']) == 1 ? 'Admin' : 'User' }}
                                @elseif ($col['key'] === 'status')
                                    {{ data_get($item, $col['key']) == 1 ? 'Active' : 'Inactive' }}
                                @else
                                    {{ data_get($item, $col['key'], 'N/A') }}
                                @endif
                            </td>
                        @endforeach
                        <td class="px-4 py-4 whitespace-nowrap text-center">
                            @if ($resource !== 'logs')
                            <form method="POST"
                                action="{{ route('general.destroy', ['resource' => $resource, 'id' => $item['id']]) }}"
                                class="delete-form" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 font-bold"
                                    title="Eliminar" onclick="event.stopPropagation();">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M9 3h6a2 2 0 012 2v2H7V5a2 2 0 012-2z" />
                                    </svg>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) + 1 }}"
                            class="px-6 py-8 text-center text-gray-500 font-medium">
                            No hay datos para mostrar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6 flex justify-center">
    {{ $data->links('pagination::tailwind') }}
</div>