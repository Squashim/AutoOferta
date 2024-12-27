@php
    $sortOptions = collect([
        (object) ['slug' => 'newest', 'name' => 'Najnowsze'],
        (object) ['slug' => 'oldest', 'name' => 'Najstarsze'],
        (object) ['slug' => 'rating_max', 'name' => 'Najwyżej oceniane'],
        (object) ['slug' => 'rating_min', 'name' => 'Najniżej oceniane'],
    ]);
@endphp

<x-guest-layout class="mb-8 mt-8 lg:mt-12 lg:max-w-7xl">
    <x-auth-session-status :status="session('success')" class="fixed left-0 top-0 z-50 w-full" />

    <header class="flex items-center justify-between gap-4 py-4">
        <div>
            <x-button type="button" style="secondary" :href="route('welcome.index') " class="flex items-center gap-2">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7-7l-7 7 7 7"></path>
                </svg>
                Strona główna
            </x-button>
            @auth
                <x-button
                    type="button"
                    style="secondary"
                    :href="route('dashboard.offers')"
                    class="flex items-center gap-2"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                        />
                    </svg>
                </x-button>
            @endauth
        </div>

        @auth
            @if ($user->id !== auth()->user()->id)
                <x-button
                    type="button"
                    style="primary"
                    :href="route('offers.search', ['userId' =>  $user->id])"
                    class="flex items-center gap-2"
                >
                    Oferty użytkownika {{ $user->name }}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7l7 7-7 7"></path>
                    </svg>
                </x-button>
            @endif
        @endauth

        @guest
            <x-button
                type="button"
                style="primary"
                :href="route('offers.search', ['userId' =>  $user->id])"
                class="flex items-center gap-2"
            >
                Oferty użytkownika {{ $user->name }}
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7l7 7-7 7"></path>
                </svg>
            </x-button>
        @endguest
    </header>
    <section class="flex flex-col gap-4">
        <header class="flex items-center justify-between rounded-md bg-slate-600 p-4">
            <div>
                @auth
                    @if ($user->id !== auth()->user()->id)
                        <h1 class="text-3xl font-semibold">Opinie o użytkowniku {{ $user->name }}</h1>
                    @else
                        <h1 class="text-3xl font-semibold">Opinie o Twoim profilu</h1>
                    @endif
                @endauth

                @guest
                    <h1 class="text-3xl font-semibold">Opinie o użytkowniku {{ $user->name }}</h1>
                @endguest

                <div class="flex flex-col md:flex-row md:gap-6 md:py-2">
                    <p class="text-lg">
                        Wystawione oferty:
                        <span class="rounded-md bg-slate-700 px-2 py-1">{{ $offerCount }}</span>
                    </p>
                    <p class="text-lg">
                        Średnia ocen:
                        <span class="w-full rounded-md bg-slate-700 px-2 py-1">
                            {{ $user->reviewsReceived->avg('rating') ? number_format($user->reviewsReceived->avg('rating'), 2) . '/5' : 'Brak' }}
                        </span>
                    </p>
                </div>
                <p class="text-gray-300">Sprzedający od {{ $user->created_at->format('Y') }}</p>
            </div>
        </header>
        <div>
            <div>
                {{-- Formularz dodania komentarza lub przycisk do zalgowania --}}
                @auth
                    @if ($user->id !== auth()->user()->id)
                        @if (isset($isEdit) && $isEdit)
                            @include('reviews.edit', ['review' => $review])
                        @else
                            @include('reviews.add')
                        @endif
                    @endif
                @endauth

                @guest
                    <x-button style="primary" type="button" class="mb-8 min-h-12 max-w-[400px]" :href="route('login')">
                        Zaloguj się, aby dodać opinię
                    </x-button>
                @endguest
            </div>
            {{-- Sekcja komentarzy --}}
            <div class="flex flex-col gap-4">
                <div class="ml-4 flex justify-between">
                    <h2 class="text-2xl font-semibold">Komentarze</h2>

                    <form action="{{ route('reviews.sort') }}" method="GET">
                        <input type="hidden" name="userId" value="{{ $user->id }}" />
                        <x-select
                            :options="$sortOptions"
                            :validationName="'sortBy'"
                            :placeholder="'Sortuj komentarze'"
                            x-on:x-select-change="setTimeout(() => ($event.target.closest('form')).submit(), 100)"
                        />
                    </form>
                </div>

                @forelse ($reviews as $reviewReceived)
                    @php
                        $isEditing = $isEdit && $review->id === $reviewReceived->id;
                    @endphp

                    @include('reviews.comment', ['reviewReceived' => $reviewReceived, 'isEdit' => $isEditing])
                @empty
                    <div
                        class="mx-auto flex h-64 w-full max-w-[500px] items-center justify-center rounded-lg bg-slate-800 shadow-lg lg:max-w-full"
                    >
                        <h3 class="text-xl font-semibold">Użytkownik nie ma komentarzy.</h3>
                    </div>
                @endforelse
                <div class="mt-6">
                    {{ $reviews->appends(request()->query())->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </section>

    @auth
        <div id="deleteModal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm">
            <div
                class="absolute left-[50%] top-[50%] w-full max-w-sm translate-x-[-50%] translate-y-[-50%] rounded-lg bg-slate-800 p-6 shadow-lg"
            >
                <h2 class="mb-4 text-xl font-bold">Potwierdzenie usunięcia</h2>
                <p class="mb-4">Czy na pewno chcesz usunąć ten komentarz?</p>
                <form id="deleteForm" method="POST" action="placeholder">
                    @csrf
                    @method('DELETE')
                    <div class="flex items-center justify-end gap-4">
                        <x-button type="button" style="secondary" onclick="closeModal()">Anuluj</x-button>
                        <x-button type="submit" class="min-w-[150px]" style="delete">Usuń</x-button>
                    </div>
                </form>
            </div>
        </div>
    @endauth
</x-guest-layout>

<script>
    function openModal(reviewId) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');

        form.action = '{{ route('reviews.destroy', ':id') }}'.replace(':id', reviewId);

        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
    }
</script>
