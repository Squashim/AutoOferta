@php
    $ratings = collect([
        (object) ['slug' => 1, 'name' => '1 Gwiazdka'],
        (object) ['slug' => 1.5, 'name' => '1.5 Gwiazdki'],
        (object) ['slug' => 2, 'name' => '2 Gwiazdki'],
        (object) ['slug' => 2.5, 'name' => '2.5 Gwiazdki'],
        (object) ['slug' => 3, 'name' => '3 Gwiazdki'],
        (object) ['slug' => 3.5, 'name' => '3.5 Gwiazdki'],
        (object) ['slug' => 4, 'name' => '4 Gwiazdki'],
        (object) ['slug' => 4.5, 'name' => '4.5 Gwiazdki'],
        (object) ['slug' => 5, 'name' => '5 Gwiazdek'],
    ]);
@endphp

<form action="{{ route('reviews.add') }}" method="POST" class="bord mb-8 flex max-w-xl flex-col gap-4 p-4">
    @csrf
    <h2 class="text-2xl font-semibold">Nowy komentarz</h2>
    <input type="hidden" name="seller_id" value="{{ $user->id }}" />
    {{-- Ocena --}}
    <div>
        <x-select :options="$ratings" :validationName="'rating'" :placeholder="'Wybierz ocenę'" :label="'Ocena'" />
        <x-input-error :messages="$errors->get('rating')" class="mt-2" />
    </div>

    {{-- Opis --}}
    <div>
        <x-input-label for="review_text" value="Komentarz" />
        <textarea
            name="review_text"
            id="review_text"
            minlength="10"
            maxlength="1000"
            title="Wprowadź komentarz do 1000 znaków. (Opcjonalny)"
            placeholder="Maksymalnie 1000 znaków. (Opcjonalny)"
            rows="4"
            class="custom-scroll mt-1 w-full resize-none overflow-y-scroll rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-indigo-600"
        >
{{ old('review_text') }}</textarea
        >
        <x-input-error :messages="$errors->get('review_text')" class="mt-2" />
    </div>
    <div class="flex gap-4">
        <x-button style="secondary" type="button" onClick="window.location.reload();" class="max-w-[400px]">
            Wyczyść
        </x-button>
        <x-button style="primary" type="submit" class="max-w-[400px]">Dodaj nowy komentarz</x-button>
    </div>
</form>
