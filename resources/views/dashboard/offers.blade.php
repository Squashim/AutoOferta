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
                    <h3 class="text-xl font-semibold">
                        Twoje ogłoszenia:
                        @if ($totalOffers > 0)
                            {{ $totalOffers }}
                        @else
                            0
                        @endif
                    </h3>
                    <x-button type="button" :href="route('offers.create')" style="primary" class="max-w-[300px]">
                        Dodaj ogłoszenie
                    </x-button>
                </header>

                @if ($totalOffers > 0)
                    @foreach ($userOffers as $offer)
                        <article
                            data-id="{{ $offer->id }}"
                            class="mx-auto flex w-full max-w-[500px] flex-col overflow-hidden rounded-lg bg-slate-800 lg:max-w-full lg:flex-row"
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
                                <div class="space-y-2 text-white">
                                    <header class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                        <h4 class="text-lg font-medium">
                                            {{ $offer->carDetails->carModel->carBrand->name }}
                                            {{ $offer->carDetails->carModel->name }}
                                            {{ $offer->carDetails->prod_year }}
                                        </h4>
                                        <p class="mt-1 text-sm font-normal text-gray-300 sm:mt-0">
                                            Liczba wyświetleń:
                                            <span class="rounded-md bg-slate-700 px-2 py-1 font-semibold">
                                                {{ $offer->view_count }}
                                            </span>
                                        </p>
                                    </header>

                                    <p>• Przebieg: {{ number_format($offer->carDetails->mileage, 0, '', ' ') }} km</p>
                                    <p>
                                        • Silnik: {{ number_format($offer->carDetails->engine_capacity, 0, '', ' ') }}
                                        cm3 - {{ $offer->carDetails->engine_power }} KM
                                    </p>
                                    <p>• Cena: {{ number_format($offer->price, 0, '', ' ') }} PLN</p>
                                    <p>• Miasto: {{ $offer->city }}</p>
                                </div>

                                <div class="mt-4 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                                    <div class="flex items-center gap-4">
                                        <x-button :href="route('dashboard.messages')" class="h-[34px]">
                                            {{ $offer->messages->where('archived', false)->unique('user_id')->count() }}
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
                                                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"
                                                />
                                            </svg>
                                        </x-button>
                                        <x-button
                                            style="secondary"
                                            type="button"
                                            onClick="window.location.href='{{route('offers.show', $offer->id)}}'"
                                        >
                                            Zobacz ogłoszenie
                                        </x-button>
                                    </div>
                                    <div class="mt-6 flex justify-end gap-4 lg:mt-0 lg:justify-normal">
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
                                    </div>
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
                        <h3 class="text-xl font-semibold">Nie masz swoich ogłoszeń!</h3>
                    </div>
                @endif
            </section>
        </div>
    </div>

    @if ($totalOffers > 0)
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
</x-app-layout>

<script>
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
</script>
