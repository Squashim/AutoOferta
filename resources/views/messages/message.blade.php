@props([
    'isFixed' => true,
])

<div
    @class([
        'fixed bottom-6 left-6 right-6 z-50 min-w-[500px] rounded-lg bg-slate-600 p-4 shadow-2xl md:left-auto md:max-w-md' => $isFixed,
        'relative' => ! $isFixed,
    ])
>
    <form
        class="flex flex-col gap-4"
        action="{{ route('messages.store', ['offer_id' => $offer_id, 'receiver_id' => $receiver_id, 'sender_id' => $sender_id]) }}"
        method="POST"
    >
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $receiver_id }}" />
        <input type="hidden" name="sender_id" value="{{ $sender_id }}" />
        <input type="hidden" name="offer_id" value="{{ $offer_id }}" />

        {{-- Opis --}}
        <div>
            <x-input-label for="message" value="Wiadmość" />
            <textarea
                name="message"
                id="message"
                minlength="10"
                maxlength="1000"
                title="Wprowadź wiadomość do 1000 znaków"
                placeholder="Maksymalnie 1000 znaków"
                rows="5"
                class="custom-scroll mt-1 w-full resize-none overflow-y-scroll rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-indigo-600"
            >
{{ old('message') }}</textarea
            >

            <x-input-error :messages="$errors->get('message')" class="mt-2" />
        </div>
        <div class="flex gap-4">
            @if ($isFixed)
                <x-button
                    style="secondary"
                    type="button"
                    :href="route('offers.show', ['offer' => $offer_id])"
                    class="max-w-[400px]"
                >
                    Anuluj
                </x-button>
            @endif

            <x-button type="submit" style="primary">Wyślij wiadomość</x-button>
        </div>
    </form>
</div>
