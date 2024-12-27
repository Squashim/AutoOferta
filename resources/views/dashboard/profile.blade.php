<x-app-layout>
    <x-auth-session-status :status="session('success')" />

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-semibold">Panel użytkownika</h1>
            <h2 class="text-2xl text-gray-200">Witaj, {{ $userName }}! 👋</h2>
            {{-- Ogłoszenia --}}
            <header class="ml-auto mt-4 flex gap-4 rounded-t-lg px-6 py-4">
                <x-button
                    type="button"
                    style="secondary"
                    :href="route('welcome.index')"
                    class="flex items-center gap-2"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="mr-2 h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7-7l-7 7 7 7"></path>
                    </svg>
                    Strona główna
                </x-button>
            </header>
            <section
                class="mb-16 flex flex-col gap-4 rounded-lg bg-gray-100 p-6 text-gray-800 shadow-md dark:bg-slate-700 dark:text-white"
            >
                <header class="flex flex-col gap-4">
                    <h3 class="text-xl font-semibold">Twój profil</h3>
                </header>

                <div class="flex w-full flex-col overflow-hidden lg:max-w-full lg:flex-row">
                    <div class="grid max-w-7xl gap-4 sm:px-6 md:grid-cols-2 lg:px-8">
                        <div class="rounded-lg bg-white p-4 shadow sm:p-8 md:col-span-2 dark:bg-gray-800">
                            <section class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        Twoje oceny i komentarze
                                    </h2>

                                    <p class="mt-1 font-medium text-gray-600 dark:text-gray-300">
                                        Tutaj pojawi się średnia ocen wystawionych przez innych użytkowników.
                                    </p>
                                    <x-button class="mt-4" :href="route('reviews.profile', $user->id) ">
                                        Zobacz komentarze
                                    </x-button>
                                </div>

                                <div>
                                    <div class="flex items-center gap-2 rounded-md bg-slate-900 p-4">
                                        <p class="text-3xl font-semibold">{{ $userRating }}</p>
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="size-7"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"
                                            />
                                        </svg>
                                    </div>
                                    <p class="mt-2 text-gray-300">Liczba komentarzy: {{ $reviewsCount }}</p>
                                </div>
                            </section>
                        </div>
                        <div class="rounded-lg bg-white p-4 shadow sm:p-8 dark:bg-gray-800">
                            <div class="max-w-xl">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>

                        <div class="rounded-lg bg-white p-4 shadow sm:p-8 dark:bg-gray-800">
                            <div class="max-w-xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>

                        <div class="rounded-lg bg-white p-4 shadow sm:p-8 md:col-span-2 dark:bg-gray-800">
                            <div>
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
