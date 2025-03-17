<nav x-data="{ open: false }" class="fixed z-[999] w-full bg-white shadow-xl dark:bg-slate-700">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <x-application-logo />
        </div>

        <div class="hidden items-center gap-2 md:flex lg:gap-4">
            @if (Route::has('login'))
                @auth
                    <x-nav-link :href="route('dashboard.offers')" :isActive="request()->is('dashboard/offers')">
                        Twoje oferty
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard.favorites')" :isActive="request()->is('dashboard/favorites')">
                        Ulubione {{ $favoritedOffers > 0 ? '(' . $favoritedOffers . ')' : '' }}
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard.messages')" :isActive="request()->is('dashboard/messages')">
                        Wiadomości
                        {{ $unreadMsgs > 0 ? '(' . $unreadMsgs . ')' : '' }}
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard.profile')" :isActive="request()->is('dashboard/profile')">
                        Profil
                    </x-nav-link>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <x-button style="secondary" class="h-8">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                />
                            </svg>
                        </x-button>
                    </form>
                @else
                    <x-button type="button" style="primary" onClick="window.location.href='login'">
                        {{ __('Log In') }}
                    </x-button>

                    @if (Route::has('register'))
                        <x-button type="button" style="secondary" onClick="window.location.href='register'">
                            {{ __('Register') }}
                        </x-button>
                    @endif
                @endauth
            @endif
        </div>

        {{-- Przycisk moblinej nawigacji --}}
        <div class="flex md:hidden">
            <button
                x-on:click="open = !open"
                :class="{'scale-110' : open}"
                class="rounded-md p-2 text-gray-800 transition duration-300 ease-in-out hover:bg-slate-800 dark:text-gray-200"
            >
                <svg
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        x-show="!open"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    ></path>
                    <path
                        x-show="open"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    ></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobilna nawigacja --}}
    <div
        x-show="open"
        class="md:hidden"
        x-transition:enter="transform transition duration-300 ease-out"
        x-transition:enter-start="translate-x-full "
        x-transition:enter-end="translate-x-0 "
        x-transition:leave="transform transition duration-200 ease-in"
        x-transition:leave-start="translate-x-0 "
        x-transition:leave-end="translate-x-full "
    >
        <div class="flex flex-col items-end justify-center gap-4 space-y-1 bg-white p-6 shadow-md dark:bg-slate-700">
            @if (Route::has('login'))
                @auth
                    <x-nav-link
                        :href="route('dashboard.offers')"
                        :isActive="request()->is('dashboard/offers')"
                        class="w-40"
                    >
                        Twoje oferty
                    </x-nav-link>
                    <x-nav-link
                        :href="route('dashboard.favorites')"
                        :isActive="request()->is('dashboard/favorites')"
                        class="w-40"
                    >
                        Ulubione {{ $favoritedOffers > 0 ? '(' . $favoritedOffers . ')' : '' }}
                    </x-nav-link>
                    <x-nav-link
                        :href="route('dashboard.messages')"
                        :isActive="request()->is('dashboard/messages')"
                        class="w-40"
                    >
                        Wiadomości {{ $unreadMsgs > 0 ? '(' . $unreadMsgs . ')' : '' }}
                    </x-nav-link>
                    <x-nav-link
                        :href="route('dashboard.profile')"
                        :isActive="request()->is('dashboard/profile')"
                        class="w-40"
                    >
                        Profil
                    </x-nav-link>

                    <form method="POST" action="{{ route('logout') }}" class="w-40">
                        @csrf

                        <x-button style="secondary" class="h-8 w-full">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                />
                            </svg>
                        </x-button>
                    </form>
                @else
                    <x-button type="button" style="primary" onClick="window.location.href='login'" class="w-40">
                        {{ __('Log In') }}
                    </x-button>

                    @if (Route::has('register'))
                        <x-button
                            type="button"
                            style="secondary"
                            onClick="window.location.href='register'"
                            class="w-40"
                        >
                            {{ __('Register') }}
                        </x-button>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>
