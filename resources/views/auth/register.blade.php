<x-guest-layout>
    <x-authentication-card class="mb-10">
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <h2 class="text-4xl font-bold text-[#023E8A] drop-shadow mb-2 text-center">REGISTER</h2>
            </div>

            <div class="mb-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input
                    id="name"
                    class="block mt-1 w-full"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Juan Pérez"
                />
            </div>

            <div class="mb-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input
                    id="email"
                    class="block mt-1 w-full"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autocomplete="username"
                    placeholder="you@gmail.com"
                />
            </div>

            <div class="mb-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input
                    id="password"
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                />
            </div>

            <div class="mb-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input
                    id="password_confirmation"
                    class="block mt-1 w-full"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <label for="terms" class="flex items-center">
                        <x-checkbox name="terms" id="terms" required />
                        <span class="ms-2 text-sm text-gray-600">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-indigo-600 hover:text-indigo-800">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-indigo-600 hover:text-indigo-800">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </span>
                    </label>
                </div>
            @endif

            <!-- Botón y enlace de login centrado -->
            <div class="flex flex-col items-center mt-6 space-y-4">
                <x-button class="w-full max-w-md py-3 text-lg rounded-xl justify-center text-center">
                    {{ __('Register') }}
                </x-button>

                <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline mt-4">
                    {{ __('Already registered?') }}
                </a>
            </div>
        </form>
    </x-authentication-card>
    <script src="https://cdn.tailwindcss.com"></script>
</x-guest-layout>