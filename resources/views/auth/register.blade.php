<x-guest-layout class="sm:max-w-md">
    <div class="py-4">
        <x-application-logo></x-application-logo>
        <h1 class="mt-6 text-3xl">Formularz rejestracji</h1>
        <p class="mt-1 opacity-75">Stwórz konto i wystaw swoje pierwsze ogłoszenie</p>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Imię')" />
            <x-text-input
                id="name"
                class="mt-1 block w-full"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                placeholder="Kamil"
                autocomplete="name"
                title="Może zawierać tylko znaki"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                class="mt-1 block w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                placeholder="kamil@poczta.pl"
                autocomplete="email"
                title="Musi zawierać adres e-mail w poprawnym formacie"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input
                passwordInput
                id="password"
                class="mt-1 block w-full"
                type="password"
                name="password"
                required
                placeholder="•••••••••"
                autocomplete="new-password"
                title="Musi zawierać co najmniej jedną cyfrę, dużą i małą literę a także co najmniej 8 znaków"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input
                passwordInput
                id="password_confirmation"
                class="mt-1 block w-full"
                type="password"
                name="password_confirmation"
                required
                placeholder="•••••••••"
                autocomplete="new-password"
                title="Musi zawierać co najmniej jedną cyfrę, dużą i małą literę a także co najmniej 8 znaków"
            />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-8 flex flex-col justify-center">
            <x-button type="submit" style="primary">
                {{ __('Register') }}
            </x-button>

            <div class="mt-4">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    * Zakładając konto, akceptujesz
                    <a
                        href="{{ route('privacy') }}"
                        class="underline hover:text-gray-900 dark:hover:text-gray-100"
                        target="_blank"
                    >
                        politykę prywatności
                    </a>
                    i
                    <a
                        href="{{ route('terms') }}"
                        class="underline hover:text-gray-900 dark:hover:text-gray-100"
                        target="_blank"
                    >
                        warunki użytkowania
                    </a>
                    serwisu Auto-oferta.pl
                </p>
            </div>

            <div class="mt-4 flex items-center justify-center gap-1">
                <p class="text-sm text-gray-600 dark:text-gray-400">Masz już konto?</p>
                <a
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}"
                >
                    Zaloguj się
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
