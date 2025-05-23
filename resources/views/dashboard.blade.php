<x-app-layout>
    <div class="w-full text-center mt-8 mb-4">
        <h1 class="text-4xl md:text-5xl font-extrabold text-[#023E8A] tracking-tight drop-shadow-lg">
            General Control Panel
        </h1>
        <p class="text-lg text-[#555] mt-2">View the summary and main statistics of the platform</p>
    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#023E8A] leading-tight flex items-center gap-2">
            <svg class="w-7 h-7 text-[#FFD60A]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0v6m0 0H7m6 0h6"></path>
            </svg>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @include('components.chart')
</x-app-layout>