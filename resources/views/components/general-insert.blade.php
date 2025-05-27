<x-app-layout> 
        @php
        // Excluir columnas por key o por label y mostrar role/status solo en users
        $tableColumns = collect($columns)
            ->filter(function ($col) use ($resource) {
                if (!is_array($col)) return false;
                // Excluir por label
                if (in_array($col['label'] ?? '', ['ID', 'Department', 'Name cYTy', 'Name tYPe'])) return false;
                // Excluir role y status si el recurso no es users
                if (in_array($col['key'], ['role', 'status']) && $resource !== 'users') return false;
                return true;
            }) 
            ->values()
            ->all();
    @endphp
    <div class="max-w-6xl mx-auto px-6">
        <h1 class="text-4xl font-bold text-[#023E8A] mb-4 pb-2">Create {{ Str::singular($resource) }}</h1>
        <form id="insert-form" action="{{ url($resource) }}" method="POST"
            class="bg-white rounded-xl shadow-lg p-10 space-y-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($tableColumns as $col)
                    @php $key = $col['key']; @endphp 
                        <div>
                            <label for="{{ $key }}"
                                class="block text-sm font-semibold text-[#023E8A] capitalize mb-1">
                                {{ $col['label'] }}
                            </label>
                            @if (Str::endsWith($key, '_id') && !empty($selectOptions[$key]))
                                <select name="{{ $key }}" id="{{ $key }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-white">
                                    <option value="">Seleccione...</option>
                                    @foreach ($selectOptions[$key] as $optionId => $optionLabel)
                                        <option value="{{ $optionId }}" {{ old($key) == $optionId ? 'selected' : '' }}>
                                            {{ $optionLabel }}
                                        </option>
                                    @endforeach
                                </select>
                            @elseif ($key === 'password')
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500" />
                            @else
                                <input type="text" name="{{ $key }}" id="{{ $key }}"
                                    value="{{ old($key) }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500" />
                            @endif
                        </div>
                @endforeach
                {{-- Select de Rol y Estado solo si el recurso es users --}}
                @if ($resource === 'users' && (!empty($selectOptions['role']) || !empty($selectOptions['status'])))
                    <div class="flex flex-col md:flex-row gap-4">
                        @if (!empty($selectOptions['role']))
                            <div class="flex-1">
                                <label for="role" class="block text-sm font-semibold text-[#023E8A] capitalize mb-1">
                                    Rol
                                </label>
                                <select name="role" id="role"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-white">
                                    <option value="">Seleccione...</option>
                                    @foreach ($selectOptions['role'] as $roleValue => $roleLabel)
                                        <option value="{{ $roleValue }}" {{ old('role') == $roleValue ? 'selected' : '' }}>
                                            {{ $roleLabel }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @if (!empty($selectOptions['status']))
                            <div class="flex-1">
                                <label for="status" class="block text-sm font-semibold text-[#023E8A] capitalize mb-1">
                                    Estado
                                </label>
                                <select name="status" id="status"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-white">
                                    <option value="">Seleccione...</option>
                                    @foreach ($selectOptions['status'] as $statusValue => $statusLabel)
                                        <option value="{{ $statusValue }}" {{ old('status') == $statusValue ? 'selected' : '' }}>
                                            {{ $statusLabel }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex flex-col sm:flex-row justify-center gap-4 pt-4">
                <a href="{{ url($resource) }}"
                    class="w-full sm:w-1/2 py-2 px-10 rounded-md font-bold bg-gray-600 text-white hover:bg-gray-800 transition text-center text-lg">CANCEL</a>
                <button type="submit"
                    class="w-full sm:w-1/2 py-2 px-10 rounded-md font-bold bg-cyan-600 text-white hover:bg-cyan-700 transition text-center text-lg">CREATE</button>
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
