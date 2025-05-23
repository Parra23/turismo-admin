<!-- Fixed Sidebar below the navbar -->
<aside
    class="fixed top-16 left-0 w-55 bg-[#00B4D8] border-r border-gray-200 shadow z-10 h-[calc(100vh-4rem)] overflow-y-auto">
    <div class="px-4 py-6 flex flex-col h-full text-sm">
        <nav class="flex-1 space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-4 py-2 hover:bg-blue-900 hover:text-white rounded transition-colors">
                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
            </a>
            <a href="{{ route('general.show', ['resource' => 'users']) }}"
                class="flex items-center px-4 py-2 hover:bg-yellow-700 hover:text-white rounded transition-colors">
                <i class="fas fa-users mr-2"></i> Users
            </a>
            <!-- Places Management -->
            <div>
                <input type="checkbox" id="lugares-toggle" class="hidden peer" />
                <label for="lugares-toggle"
                    class="flex justify-between items-center px-4 py-2 hover:bg-purple-600 hover:text-white rounded transition-colors cursor-pointer select-none">
                    <span class="flex items-center"><i class="fas fa-map-marked-alt mr-2"></i> Places Management</span>
                    <svg class="w-4 h-4 transition-transform peer-checked:rotate-180" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </label>
                <div class="hidden peer-checked:block w-full space-y-1 mt-1">
                    <a href="{{ route('general.show', ['resource' => 'departments']) }}"
                        class="flex items-center pl-8 pr-4 py-2 hover:bg-gray-100 rounded">
                        <i class="fas fa-map mr-2"></i> Departments
                    </a>
                    <a href="{{ route('general.show', ['resource' => 'cities']) }}" class="flex items-center pl-8 pr-4 py-2 hover:bg-gray-100 rounded">
                        <i class="fas fa-city mr-2"></i> Cities
                    </a>
                    <a href="{{ route('general.show', ['resource' => 'placetypes']) }}" class="flex items-center pl-8 pr-4 py-2 hover:bg-gray-100 rounded">
                        <i class="fas fa-tags mr-2"></i> Place Types
                    </a>
                    <a href="#" class="flex items-center pl-8 pr-4 py-2 hover:bg-gray-100 rounded">
                        <i class="fas fa-map-pin mr-2"></i> Places
                    </a>
                    <a href="{{ route('general.show', ['resource' => 'photos']) }}" class="flex items-center pl-8 pr-4 py-2 hover:bg-gray-100 rounded">
                        <i class="fas fa-image mr-2"></i> Photos
                    </a>
                </div>
            </div>
            <!-- Actions Management -->
            <div>
                <input type="checkbox" id="acciones-toggle" class="hidden peer" />
                <label for="acciones-toggle"
                    class="flex justify-between items-center px-4 py-2 hover:bg-orange-700 hover:text-white rounded transition-colors cursor-pointer select-none">
                    <span class="flex items-center"><i class="fas fa-tasks mr-2 "></i> Actions Management</span>
                    <svg class="w-4 h-4 transition-transform peer-checked:rotate-180" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </label>
                <div class="hidden peer-checked:block w-full space-y-1 mt-1">
                    <a href="#" class="flex items-center pl-8 pr-4 py-2 hover:bg-gray-100 rounded">
                        <i class="fas fa-comment mr-2"></i> Comments
                    </a>
                    <a href="#" class="flex items-center pl-8 pr-4 py-2 hover:bg-gray-100 rounded">
                        <i class="fas fa-thumbs-up mr-2"></i> Reactions
                    </a>
                    <a href="#" class="flex items-center pl-8 pr-4 py-2 hover:bg-gray-100 rounded">
                        <i class="fas fa-heart mr-2"></i> Favorites
                    </a>
                </div>
            </div>
            <a href="#"
                class="flex items-center px-4 py-2 hover:bg-green-700 hover:text-white rounded transition-colors">
                <i class="fas fa-file-alt mr-2"></i> Logs
            </a>
        </nav>
        <!-- Sidebar Footer -->
        <div class="mt-auto py-4 border-t border-black">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center w-full px-4 py-2 hover:bg-red-600 hover:text-white rounded transition-colors">
                    <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                </button>
            </form>
        </div>
    </div>
</aside>
