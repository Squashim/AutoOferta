<x-guest-layout class="mb-8 mt-8 lg:mt-12 lg:max-w-7xl">
    {{-- Powiadomienie --}}
    <div
        id="notification"
        class="fixed left-0 right-0 top-0 hidden h-16 bg-green-600 px-6 py-4 text-lg font-medium text-white transition-all duration-300"
        style="z-index: 1000"
    >
        <span id="notification-message"></span>
    </div>

    <x-auth-session-status :status="session('success')" class="fixed left-0 top-0 z-50 w-full" />

    <header class="flex items-center gap-4 py-4">
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
    </header>

    <section>
        <article class="grid w-full justify-between gap-6 lg:grid-cols-3">
            {{-- Zdjecia --}}
            <div
                class="relative flex w-full overflow-hidden lg:col-span-2"
                x-data="slider({{ $offer->images->count() }})"
                id="img-slider"
            >
                <div
                    class="flex w-full transition-transform duration-500"
                    :style="`transform: translateX(-${currentIndex * 100}%);`"
                >
                    @foreach ($offer->images as $image)
                        <img
                            loading="lazy"
                            class="w-full flex-shrink-0 rounded-lg object-cover sm:max-h-[300px] md:max-h-[400px] lg:max-h-[500px]"
                            src="{{ asset('storage/' . $image->path) }}"
                            alt="Ofeta {{ $offer->carDetails->carModel->carBrand->name }} {{ $offer->carDetails->carModel->name }}-{{ $image->id }}"
                        />
                    @endforeach
                </div>

                <div class="absolute top-[50%] flex w-full translate-y-[-50%] items-center justify-between px-2">
                    <button type="button" class="rounded-md bg-black/20 p-2 hover:bg-black/60" x-on:click="prev">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            class="size-6 stroke-white stroke-[3]"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <button type="button" class="rounded-md bg-black/20 p-2 hover:bg-black/60" x-on:click="next">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            class="size-6 stroke-white stroke-[3]"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
                <div
                    id="pagination"
                    class="absolute bottom-0 flex w-full items-center justify-center gap-2 bg-black/40 p-2"
                >
                    @foreach ($offer->images as $index => $image)
                        <button
                            :class="{'bg-indigo-600': currentIndex === {{ $index }}, 'bg-white': currentIndex !== {{ $index }}}"
                            class="h-3 w-3 rounded-full border-2"
                            x-on:click="goTo({{ $index }})"
                        ></button>
                    @endforeach
                </div>
            </div>

            {{-- Informacje --}}
            <div class="flex flex-col gap-6">
                <header>
                    <h1 class="text-3xl font-semibold">
                        {{ $offer->carDetails->carModel->carBrand->name }}
                        {{ $offer->carDetails->carModel->name }}
                    </h1>
                    <p class="text-lg text-gray-300">
                        {{ $offer->carDetails->car_condition }} • {{ $offer->carDetails->prod_year }}
                    </p>
                </header>

                <h2 class="text-3xl font-medium">{{ number_format($offer->price, 0, '', ' ') }} PLN</h2>
                {{-- Kontaktowe --}}
                <div class="flex max-w-md flex-col gap-2 rounded-lg border p-4">
                    <header class="flex items-center justify-between">
                        <h3 class="text-lg font-medium">Osoba prywatna</h3>
                        @auth
                            @if ($offer->user_id !== auth()->user()->id)
                                <button
                                    type="button"
                                    data-offer-id="{{ $offer->id }}"
                                    class="favorite-button transition-all duration-200 hover:scale-125"
                                    aria-pressed="{{ auth()->user() && auth()->user()->favorites->contains($offer->id) ? 'true' : 'false' }}"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="{{ auth()->user() && auth()->user()->favorites->contains($offer->id) ? 'currentColor' : 'none' }}"
                                        viewBox="0 0 24 24"
                                        class="size-6"
                                        stroke="currentColor"
                                    >
                                        <path
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                                        />
                                    </svg>
                                </button>
                            @endif
                        @endauth
                    </header>
                    <div class="-mt-2">
                        @auth
                            @if ($offer->user_id !== auth()->user()->id)
                                <a
                                    class="font-medium underline"
                                    href="{{ route('reviews.profile', $offer->user_id) }}"
                                >
                                    {{ $offer->user->name }}
                                </a>
                            @else
                                <p class="font-medium">Ty</p>
                            @endif
                        @endauth

                        @guest
                            <a class="font-medium underline" href="{{ route('reviews.profile', $offer->user_id) }}">
                                {{ $offer->user->name }}
                            </a>
                        @endguest

                        <div class="flex items-center gap-1">
                            <p>{{ $userRating }}</p>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-4"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"
                                />
                            </svg>
                        </div>

                        <p class="text-sm text-gray-300">Sprzedający od {{ $offer->user->created_at->format('Y') }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="mt-2 text-lg font-medium">Kontakt</h3>
                        <div
                            class="mb-2 flex items-center justify-center gap-1 rounded-md bg-slate-800 py-2 text-lg font-medium shadow-inner"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"
                                />
                            </svg>

                            <p>
                                +48
                                {{ substr($offer->phone, 0, 3) . ' ' . substr($offer->phone, 3, 3) . ' ' . substr($offer->phone, 6) }}
                            </p>
                        </div>
                        @auth
                            @if ($offer->user_id !== auth()->user()->id)
                                @if ($message)
                                    @include('messages.message', ['offer_id' => $offer->id, 'sender_id' => auth()->user()->id, 'receiver_id' => $offer->user_id])
                                @else
                                    @php
                                        $fetchedMessage = $offer->messages
                                            ->where('sender_id', auth()->user()->id)
                                            ->where('receiver_id', $offer->user_id)
                                            ->first();
                                        $isArchived = null;
                                        if ($fetchedMessage) {
                                            $isArchived = $fetchedMessage->archived;
                                        } else {
                                            $isArchived = false;
                                        }
                                    @endphp

                                    @if ($isArchived === null)
                                        <x-button style="primary" disabled class="min-h-12 max-w-[400px]">
                                            Ładowanie...
                                        </x-button>
                                    @elseif ($isArchived)
                                        <x-button style="primary" disabled class="min-h-12 max-w-[400px]">
                                            Konwersacja zarchiwizowana
                                        </x-button>
                                    @else
                                        <x-button
                                            style="primary"
                                            :href="route('messages.show', ['offer_id' => $offer->id, 'sender_id' => auth()->user()->id, 'receiver_id' => $offer->user_id])"
                                            class="min-h-12 max-w-[400px]"
                                        >
                                            Napisz wiadomość
                                        </x-button>
                                    @endif
                                @endif
                            @else
                                <x-button
                                    style="edit"
                                    type="button"
                                    onClick="window.location.href='{{route('offers.edit', $offer->id)}}'"
                                >
                                    Edytuj
                                </x-button>
                                <x-button style="delete" type="button" onClick="openModal({{$offer->id}})">
                                    Usuń
                                </x-button>
                            @endif
                        @endauth

                        @guest
                            <x-button
                                style="primary"
                                type="button"
                                class="min-h-12 max-w-[400px]"
                                onClick="window.location.href='/login'"
                            >
                                Zaloguj się, aby wysłać wiadomość
                            </x-button>
                        @endguest
                    </div>
                    <div class="mt-2 text-gray-300">
                        <div class="flex items-center gap-1 text-sm">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"
                                />
                            </svg>
                            <p class="text-lg">{{ $offer->city }}</p>
                        </div>
                        <p class="mt-1 text-sm">Opublikowano {{ $offer->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <div class="col-span-full flex flex-col gap-6">
                <div class="flex flex-col gap-4">
                    <h3 class="mt-2 text-2xl font-semibold">Najważniejsze informacje</h3>
                    <ul
                        class="flex w-full flex-wrap items-center justify-center gap-4 text-center sm:justify-start lg:flex-row"
                    >
                        <li class="flex flex-col items-center justify-center rounded-md bg-slate-900 p-2">
                            <p class="text-md text-gray-300">Przebieg</p>
                            <p class="text-lg font-semibold">
                                {{ number_format($offer->carDetails->mileage, 0, '', ' ') }} km
                            </p>
                        </li>
                        <li class="flex flex-col items-center justify-center rounded-md bg-slate-900 p-2">
                            <p class="text-md text-gray-300">Rodzaj paliwa</p>
                            <p class="text-lg font-semibold">{{ $offer->carDetails->fuel_type }}</p>
                        </li>
                        <li class="flex flex-col items-center justify-center rounded-md bg-slate-900 p-2">
                            <p class="text-md text-gray-300">Skrzynia biegów</p>
                            <p class="text-lg font-semibold">{{ $offer->carDetails->transmission }}</p>
                        </li>
                        <li class="flex flex-col items-center justify-center rounded-md bg-slate-900 p-2">
                            <p class="text-md text-gray-300">Typ nadwozia</p>
                            <p class="text-lg font-semibold">{{ $offer->carDetails->car_type }}</p>
                        </li>
                        <li class="flex flex-col items-center justify-center rounded-md bg-slate-900 p-2">
                            <p class="text-md text-gray-300">Pojemność skokowa</p>
                            <p class="text-lg font-semibold">
                                {{ number_format($offer->carDetails->engine_capacity, 0, '', ' ') }} cm3
                            </p>
                        </li>
                        <li class="flex flex-col items-center justify-center rounded-md bg-slate-900 p-2">
                            <p class="text-md text-gray-300">Moc</p>
                            <p class="text-lg font-semibold">{{ $offer->carDetails->engine_power }} KM</p>
                        </li>
                    </ul>
                </div>

                <div class="flex flex-col gap-4">
                    <h3 class="text-2xl font-semibold">Opis</h3>
                    <p class="custom-scroll min-h-[150px] overflow-y-scroll rounded-lg bg-slate-800 p-4">
                        {{ $offer->description }}
                    </p>
                </div>

                <div class="grid gap-4 md:grid-cols-2 md:gap-x-8">
                    <h3 class="text-2xl font-semibold md:col-span-full">Szczegóły</h3>
                    <div class="flex flex-col gap-6 px-4">
                        <h4 class="rounded-md bg-slate-800 p-2 text-lg font-medium">Podstawowe</h4>
                        <div class="flex flex-col">
                            <div class="flex items-center justify-between border-t border-gray-300 py-2">
                                <p class="text-gray-300">Marka pojazdu</p>
                                <p>{{ $offer->carDetails->carModel->carBrand->name }}</p>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-300 py-2">
                                <p class="text-gray-300">Model pojazdu</p>
                                <p>{{ $offer->carDetails->carModel->name }}</p>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-300 py-2">
                                <p class="text-gray-300">Numer VIN</p>
                                <p>{{ $offer->carDetails->vin }}</p>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-300 py-2">
                                <p class="text-gray-300">Kolor</p>
                                <p>{{ $offer->carDetails->color }}</p>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-300 py-2">
                                <p class="text-gray-300">Rok produkcji</p>
                                <p>{{ $offer->carDetails->prod_year }}</p>
                            </div>
                            <div class="flex items-center justify-between border-b border-t border-gray-300 py-2">
                                <p class="text-gray-300">Stan</p>
                                <p>{{ $offer->carDetails->car_condition }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-6 px-4">
                        <h4 class="rounded-md bg-slate-800 p-2 text-lg font-medium">Specyfikacja</h4>
                        <div class="flex flex-col px-2">
                            <div class="flex items-center justify-between border-t border-gray-300 py-2">
                                <p class="text-gray-300">Rodzaj paliwa</p>
                                <p>{{ $offer->carDetails->fuel_type }}</p>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-300 py-2">
                                <p class="text-gray-300">Pojemność skokowa</p>
                                <p>{{ $offer->carDetails->engine_capacity }}</p>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-300 py-2">
                                <p class="text-gray-300">Moc</p>
                                <p>{{ $offer->carDetails->engine_power }}</p>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-300 py-2">
                                <p class="text-gray-300">Typ nadwozia</p>
                                <p>{{ $offer->carDetails->car_type }}</p>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-300 py-2">
                                <p class="text-gray-300">Skrzynia biegów</p>
                                <p>{{ $offer->carDetails->transmission }}</p>
                            </div>
                            <div class="flex items-center justify-between border-b border-t border-gray-300 py-2">
                                <p class="text-gray-300">Napęd</p>
                                <p>{{ $offer->carDetails->drive_type }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-4">
                    <h3 class="text-2xl font-semibold">Wyposażenie</h3>
                    <x-accordion.group>
                        @foreach ($features as $categoryName => $featuresInCategory)
                            <x-accordion.item :label="$categoryName" class="text-lg">
                                @foreach ($featuresInCategory as $feature)
                                    <li>{{ $feature->feature_name }}</li>
                                @endforeach
                            </x-accordion.item>
                        @endforeach
                    </x-accordion.group>
                </div>
            </div>

            <div class="col-span-full flex flex-col gap-4">
                <h3 class="text-2xl font-semibold">Lokalizacja</h3>
                <iframe
                    height="300"
                    class="rounded-md"
                    frameborder="0"
                    scrolling="no"
                    marginheight="0"
                    marginwidth="0"
                    src="https://maps.google.com/maps?width=100%25&amp;height=300&amp;hl=pl&amp;q={{ $offer->city }}+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                ></iframe>
            </div>
        </article>
    </section>
    @auth
        @if ($offer->user_id === auth()->user()->id)
            <div id="deleteModal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm">
                <div
                    class="absolute left-[50%] top-[50%] w-full max-w-sm translate-x-[-50%] translate-y-[-50%] rounded-lg bg-slate-800 p-6 shadow-lg"
                >
                    <h2 class="mb-4 text-xl font-bold">Potwierdzenie usunięcia</h2>
                    <p class="mb-4">Czy na pewno chcesz usunąć to ogłoszenie?</p>
                    <form id="deleteForm" method="POST" action="{{ route('offers.destroy', $offer->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="flex items-center justify-end gap-4">
                            <x-button type="button" style="secondary" onclick="closeModal()">Anuluj</x-button>
                            <x-button type="submit" class="min-w-[150px]" style="delete">Usuń</x-button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endauth
</x-guest-layout>

<script>
    function slider(totalSlides) {
        return {
            currentIndex: 0,
            total: totalSlides,
            next() {
                this.currentIndex = (this.currentIndex + 1) % this.total;
            },
            prev() {
                this.currentIndex = (this.currentIndex - 1 + this.total) % this.total;
            },
            goTo(index) {
                this.currentIndex = index;
            },
        };
    }

    function openModal(offerId) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');

        form.action = form.action.replace(/\/\d+$/, `/${offerId}`);

        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', () => {
        const notification = document.getElementById('notification');
        const notificationMessage = document.getElementById('notification-message');

        function showNotification(message, type = 'success') {
            notificationMessage.textContent = message;

            notification.classList.remove('bg-green-600', 'bg-red-600', 'bg-blue-600');
            if (type === 'success') {
                notification.classList.add('bg-green-600');
            } else if (type === 'error') {
                notification.classList.add('bg-red-600');
            } else if (type === 'info') {
                notification.classList.add('bg-blue-600');
            }

            notification.classList.remove('hidden', 'opacity-0');
            notification.classList.add('opacity-100');

            setTimeout(() => {
                hideNotification();
            }, 5000);
        }

        function hideNotification() {
            notification.classList.add('opacity-0');
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 300);
        }

        const button = document.querySelector('.favorite-button');
        // Przyciski dodwanie do ulubionych

        if (button) {
            button.addEventListener('click', function () {
                const offerId = this.getAttribute('data-offer-id');
                const svgIcon = this.querySelector('svg');
                const isPressed = this.getAttribute('aria-pressed') === 'true';

                fetch('{{ route('favorite.toggle') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ offer_id: offerId }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        showNotification(data.message, 'success');

                        if (data.favorited) {
                            svgIcon.setAttribute('fill', 'currentColor');
                            this.setAttribute('aria-pressed', 'true');
                        } else {
                            svgIcon.setAttribute('fill', 'none');
                            this.setAttribute('aria-pressed', 'false');
                        }
                    })
                    .catch((error) => console.error('Error:', error));
            });
        }
    });
</script>
