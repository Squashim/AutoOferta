<x-app-layout>
    <x-auth-session-status :status="session('success')" />
    {{-- Powiadomienie --}}
    <div
        id="notification"
        class="fixed left-0 right-0 top-0 hidden h-16 bg-green-600 px-6 py-4 text-lg font-medium text-white transition-all duration-300"
        style="z-index: 1000"
    >
        <span id="notification-message"></span>
    </div>

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
                    <h3 class="text-xl font-semibold">
                        Polubione ogłoszenia:
                        @if ($totalFavorites > 0)
                            {{ $totalFavorites }}
                        @else
                            0
                        @endif
                    </h3>
                    <x-button
                        type="button"
                        onClick="window.location.href='{{route('welcome.index')}}'"
                        style="primary"
                        class="max-w-[300px]"
                    >
                        Znajdź ogłoszenia
                    </x-button>
                </header>

                @if ($totalFavorites > 0)
                    @foreach ($userOffers as $offer)
                        <article
                            data-id="{{ $offer->id }}"
                            class="mx-auto flex w-full max-w-[500px] flex-col overflow-hidden rounded-lg bg-slate-800 shadow-lg lg:max-w-full lg:flex-row"
                        >
                            <div
                                class="relative flex w-full overflow-hidden lg:w-1/3"
                                x-data="slider({{ $offer->images->count() }})"
                                id="img-slider"
                            >
                                <div
                                    class="flex transition-transform duration-500"
                                    :style="`transform: translateX(-${currentIndex * 100}%);`"
                                >
                                    @foreach ($offer->images as $image)
                                        <img
                                            loading="lazy"
                                            class="h-64 w-full flex-shrink-0 rounded-t-lg object-cover lg:rounded-l-lg lg:rounded-tr-none"
                                            src="{{ asset('storage/' . $image->path) }}"
                                            alt="Ofeta {{ $offer->carDetails->carModel->carBrand->name }} {{ $offer->carDetails->carModel->name }}-{{ $image->id }}"
                                        />
                                    @endforeach
                                </div>

                                <div
                                    class="absolute top-[50%] flex w-full translate-y-[-50%] items-center justify-between px-2"
                                >
                                    <button
                                        type="button"
                                        class="rounded-md bg-black/20 p-2 hover:bg-black/60"
                                        x-on:click="prev"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            class="size-6 stroke-white stroke-[3]"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15.75 19.5 8.25 12l7.5-7.5"
                                            />
                                        </svg>
                                    </button>
                                    <button
                                        type="button"
                                        class="rounded-md bg-black/20 p-2 hover:bg-black/60"
                                        x-on:click="next"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            class="size-6 stroke-white stroke-[3]"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="m8.25 4.5 7.5 7.5-7.5 7.5"
                                            />
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

                            <div class="flex flex-1 flex-col justify-between space-y-4 p-4">
                                <ul class="space-y-2 text-white">
                                    <li class="text-lg font-medium">
                                        {{ $offer->carDetails->carModel->carBrand->name }}
                                        {{ $offer->carDetails->carModel->name }}
                                        {{ $offer->carDetails->prod_year }}
                                    </li>
                                    <li>Przebieg: {{ $offer->carDetails->mileage }} km</li>
                                    <li>
                                        Silnik: {{ $offer->carDetails->engine_capacity }}cm/3 -
                                        {{ $offer->carDetails->engine_power }}KM
                                    </li>
                                    <li>Cena: {{ number_format($offer->price, 0, '', ' ') }} PLN</li>
                                    <li>Miasto: {{ $offer->city }}</li>
                                </ul>

                                <div class="mt-4 flex flex-col gap-4 md:flex-row md:items-center">
                                    @auth
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
                                    @endauth

                                    <x-button
                                        style="secondary"
                                        type="button"
                                        onClick="window.location.href='{{route('offers.show', $offer->id)}}'"
                                    >
                                        Zobacz ogłoszenie
                                    </x-button>
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
                                        <x-button style="primary" disabled>Ładowanie...</x-button>
                                    @elseif ($isArchived)
                                        <x-button style="primary" disabled>Konwersacja zarchiwizowana</x-button>
                                    @else
                                        <x-button
                                            style="primary"
                                            type="button"
                                            :href="route('messages.show', ['offer_id' => $offer->id, 'sender_id' => auth()->user()->id, 'receiver_id' => $offer->user_id])"
                                        >
                                            Napisz wiadomość
                                        </x-button>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach

                    <div class="mt-6">
                        {{ $userOffers->links('pagination::tailwind') }}
                    </div>
                @else
                    <div
                        class="mx-auto flex h-64 w-full max-w-[500px] items-center justify-center rounded-lg bg-slate-800 shadow-lg lg:max-w-full"
                    >
                        <h3 class="text-xl font-semibold">Nie masz polubionych ogłoszeń!</h3>
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-app-layout>

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

    document.addEventListener('DOMContentLoaded', () => {
        const noOffers = @json($userOffers->isEmpty());
        const currentPage = @json($userOffers->currentPage());
        const totalPages = @json($userOffers->lastPage());

        if (noOffers && currentPage > 1) {
            window.location.href = `{{ route('dashboard.favorites') }}?page=1`;
        }
    });

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

        // Przyciski dodwanie do ulubionych
        const buttons = document.querySelectorAll('.favorite-button');

        buttons.forEach((button) => {
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

                        window.location.reload();
                    })
                    .catch((error) => console.error('Error:', error));
            });
        });
    });
</script>
