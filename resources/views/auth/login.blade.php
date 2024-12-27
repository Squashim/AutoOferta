<x-guest-layout class="sm:max-w-md">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="py-4">
        <x-application-logo></x-application-logo>
        <h1 class="mt-6 text-3xl">Witaj ponownie!</h1>
        <p class="mt-1 opacity-75">Wprowadź swoje dane logowania poniżej</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />

            <x-text-input
                id="email"
                class="mt-1 block w-full"
                type="email"
                name="email"
                :value="old('email')"
                placeholder="kamil@poczta.pl"
                maxLength="255"
                required
                autofocus
                autocomplete="email"
                title="Musi zawierać adres e-mail w poprawnym formacie"
            />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            <x-input-label for="password" :value="__('Password')" />

            <x-text-input
                id="password"
                class="mt-1 block w-full"
                type="password"
                name="password"
                placeholder="•••••••••"
                maxLength="255"
                required
                autocomplete="current-password"
                title="Musi zawierać co najmniej jedną cyfrę, dużą i małą literę a także co najmniej 8 znaków"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mt-4 flex items-center justify-between">
            <label for="remember_me" class="inline-flex cursor-pointer items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="cursor-pointer rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember"
                />
                <span class="ms-2 select-none text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a
                    class="rounded-md text-right text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}"
                >
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="flex flex-col justify-center py-4">
            <x-button type="submit" class="w-full" style="primary">
                {{ __('Log In') }}
            </x-button>

            <div class="mt-2 flex items-center justify-center gap-1">
                <p class="text-sm text-gray-600 dark:text-gray-400">Nie masz konta?</p>
                <a
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                    href="{{ route('register') }}"
                >
                    Załóż nowe
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
