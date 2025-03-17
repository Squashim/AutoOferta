@props([
    'reviewReceived',
    'isEdit' => false,
])

{{-- Zmiana stylu podczas edycji komentarza --}}
<div
    class="{{ $isEdit ? 'pointer-events-none relative select-none bg-slate-800/70' : '' }} flex flex-col gap-2 rounded-md bg-slate-800 p-4"
>
    {{-- Informacja o edycji --}}
    @if ($isEdit)
        <span
            class="absolute left-0 top-0 z-10 flex h-full w-full items-center justify-center rounded-md bg-black/40 text-xl tracking-wide backdrop-blur-sm"
        >
            Edytujesz...
        </span>
    @endif

    <div class="flex flex-col gap-2">
        {{-- Użytkownik --}}
        <p>
            <strong>Komentujący:</strong>
            @auth
                @if ($reviewReceived->user_id === auth()->user()->id)
                    Ty
                @else
                    {{ $reviewReceived->user->name }}
                @endif
            @endauth

            @guest
                {{ $reviewReceived->user->name }}
            @endguest
        </p>
        {{-- Gwiazdki --}}
        <div class="flex items-center gap-2">
            <strong>Ocena:</strong>
            <div class="flex">
                @php
                    $fullStars = floor($reviewReceived->rating);
                    $hasHalfStar = $reviewReceived->rating - $fullStars >= 0.5;
                    $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                @endphp

                @for ($i =0 ;$i<$fullStars; $i++)
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
                @endfor

                @if ($hasHalfStar)
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-4"
                    >
                        <defs>
                            <linearGradient id="half-fill" x1="0" x2="1" y1="0" y2="0">
                                <stop offset="50%" stop-color="currentColor" stop-opacity="1" />
                                <stop offset="50%" stop-color="currentColor" stop-opacity="0" />
                            </linearGradient>
                        </defs>
                        <path
                            fill="url(#half-fill)"
                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"
                        />
                    </svg>
                @endif

                @for ($i = 0; $i < $emptyStars; $i++)
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
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
                @endfor

                <small class="ml-1">({{ $reviewReceived->rating }}/5)</small>
            </div>
        </div>
        {{-- Opis --}}
        @if ($reviewReceived->review_text)
            <p class="custom-scroll h-auto max-h-64 w-full overflow-y-auto break-words rounded-md bg-slate-900 p-2">
                {{ $reviewReceived->review_text }}
            </p>
        @endif

        {{-- Data --}}

        @if ($reviewReceived->created_at->eq($reviewReceived->updated_at))
            <small><em>Dodano {{ $reviewReceived->created_at->isoformat('D.M.Y  H:mm') }}</em></small>
        @else
            <div class="flex flex-wrap gap-6">
                <small><em>Dodano {{ $reviewReceived->created_at->isoformat('D.M.Y  H:mm') }}</em></small>
                <small><em>Edytowano {{ $reviewReceived->updated_at->isoformat('D.M.Y H:mm') }}</em></small>
            </div>
        @endif
    </div>

    {{-- Przyciski do zarzadzania, jesli uzytkownik jest tworca komentarza --}}
    @auth
        @if ($reviewReceived->user_id === auth()->user()->id)
            <div class="flex items-center gap-4">
                <x-button
                    type="button"
                    style="edit"
                    :href="route('reviews.edit',['seller_id' => $reviewReceived->seller_id, 'review_id' => $reviewReceived->id])"
                >
                    Edytuj
                </x-button>
                <x-button type="button" style="delete" onClick="openModal({{$reviewReceived->id}})">Usuń</x-button>
            </div>
        @endif
    @endauth

    {{-- Przycisk do usuwania komentarzy, jesli oceny sa o zalogowanym uzytkowniku --}}
    @auth
        @if ($reviewReceived->seller_id === auth()->user()->id)
            <div class="flex items-center gap-4">
                <x-button type="button" style="delete" onClick="openModal({{$reviewReceived->id}})">Usuń</x-button>
            </div>
        @endif
    @endauth
</div>
