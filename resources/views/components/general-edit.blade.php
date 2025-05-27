<!-- filepath: c:\Users\jparr\turismo\resources\views\edit.blade.php -->
<x-app-layout>
    @php
        // Excluir columnas por key o por label
        $tableColumns = collect($columns)
            ->filter(function ($col) {
                return is_array($col) && !in_array($col['label'] ?? '', ['Department', 'Name cYTy', 'Name tYPe', 'plACe Name', 'USER NAME', 'Comment Date', 'Place name']);
            })
            ->values()
            ->all();
    @endphp
    <div class="max-w-6xl mx-auto px-2 sm:px-4 md:px-6">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#023E8A] mb-4 pb-2">
            Edit {{ Str::singular($resource) }}
        </h1>
        @php
            // Busca el primer campo que termine en '_id' o sea 'id'
            $idField = collect($registro)
                ->keys()
                ->first(function ($key) {
                    return Str::endsWith($key, '_id') || $key === 'id';
                });
            $registroId = data_get($registro, $idField);
        @endphp
        <form id="edit-form" action="{{ url($resource . '/' . $registroId) }}" method="POST"
            class="bg-white rounded-xl shadow-lg p-4 sm:p-8 md:p-10 space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                @foreach ($tableColumns as $col)
                    @php $key = $col['key']; @endphp
                    @if ($key !== $idField && $key !== 'created_at' && $key !== 'updated_at' && !in_array($key, ['role', 'status']))
                        <div>
                            <label for="{{ $key }}"
                                class="block text-sm font-semibold text-[#023E8A] capitalize mb-1">
                                {{ $col['label'] }}
                            </label>
                            @if ((Str::endsWith($key, '_id') || $key === 'id') && !empty($selectOptions[$key]))
                                <select name="{{ $key }}" id="{{ $key }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                    <option value="">Seleccione...</option>
                                    @foreach ($selectOptions[$key] as $optionId => $optionLabel)
                                        <option value="{{ $optionId }}"
                                            {{ old($key, $registro[$key] ?? '') == $optionId ? 'selected' : '' }}>
                                            {{ $optionLabel }}
                                        </option>
                                    @endforeach
                                </select>
                            @elseif ($key === 'password')
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500" />
                            @else
                                <input type="text" name="{{ $key }}" id="{{ $key }}"
                                    value="{{ old($key, $registro[$key] ?? '') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500" />
                            @endif
                        </div>
                    @endif
                @endforeach

                {{-- Select de Rol --}}
                @if ($resource === 'users' && !empty($selectOptions['role']))
                    <div>
                        <label for="role" class="block text-sm font-semibold text-[#023E8A] capitalize mb-1">
                            Rol
                        </label>
                        <select name="role" id="role"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-white">
                            <option value="">Seleccione...</option>
                            @foreach ($selectOptions['role'] as $roleValue => $roleLabel)
                                <option value="{{ $roleValue }}"
                                    {{ old('role', $registro['role'] ?? '') == $roleValue ? 'selected' : '' }}>
                                    {{ $roleLabel }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
                {{-- Select de Status --}}
                @if ($resource === 'users' && !empty($selectOptions['status']))
                    <div>
                        <label for="status" class="block text-sm font-semibold text-[#023E8A] capitalize mb-1">
                            Status
                        </label>
                        <select name="status" id="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-white">
                            <option value="">Seleccione...</option>
                            @foreach ($selectOptions['status'] as $statusValue => $statusLabel)
                                <option value="{{ $statusValue }}"
                                    {{ old('status', $registro['status'] ?? '') == $statusValue ? 'selected' : '' }}>
                                    {{ $statusLabel }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
            <div class="flex flex-col sm:flex-row justify-center gap-4 pt-4">
                <a href="{{ url($resource) }}"
                    class="w-full sm:w-1/2 py-1 px-10 rounded-md font-bold bg-gray-600 text-white hover:bg-gray-800 transition text-center text-lg">CANCEL</a>
                <button type="submit"
                    class="w-full sm:w-1/2 py-1 px-10 rounded-md font-bold bg-cyan-600 text-white hover:bg-cyan-700 transition text-center text-lg">UPDATE</button>
            </div>

            {{-- Mensajes de error y éxito --}}
            @if (session('error'))
                <div class="mt-4 text-center text-red-600 font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="mt-4 text-center text-green-600 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mt-4 text-center text-red-600 font-semibold">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

        </form>
    </div>
</x-app-layout>
