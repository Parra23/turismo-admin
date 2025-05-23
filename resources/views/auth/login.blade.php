    <x-guest-layout>
        <x-authentication-card>
            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>
            <x-validation-errors class="mb-4" />
            @vite(['resources/css/app.css', 'resources/js/app.js'])
            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ $value }}
                </div>
            @endsession
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Título -->
                <div>
                    <h2 class="text-4xl font-bold text-[#023E8A] drop-shadow mb-2 text-center">LOG IN</h2>
                </div>

                <!-- Campo Email -->
                <div>
                    <x-label for="email " :value="__('Email')" />
                    <x-input id="email" type="email" name="email" :value="old('email')" required autofocus
                        autocomplete="username" placeholder="you@example.com" class="block w-full mt-1" />
                </div>

                <!-- Campo Contraseña -->
                <div>
                    <x-label for="password" :value="__('Password')"/>
                    <x-input id="password" type="password" name="password" required autocomplete="current-password"
                        placeholder="••••••••" class="block w-full mt-1 " />
                </div>

                <!-- Recordarme -->
                <div class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <label for="remember_me" class="ml-2 text-sm text-gray-600">
                        {{ __('Remember me') }}
                    </label>
                </div>
                <!-- Botón "Log in" centrado y más grande -->
                <div class="flex justify-center mt-6">
                    <div class="w-full max-w-md">
                        <x-button class="w-full py-3 text-lg rounded-xl text-center justify-center">
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </div>
                <!-- Acciones -->
                <div class="flex items-center justify-between">
                    <!-- Enlace para registrarse -->
                    @if (Route::has('register'))
                        <div>
                            <p class="text-sm text-gray-600">
                                Not a member?
                                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">
                                    Register here
                                </a>
                            </p>
                        </div>
                    @endif
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-gray-600 hover:text-indigo-600 underline">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </x-authentication-card>
        <script src="https://cdn.tailwindcss.com"></script>
    </x-guest-layout>