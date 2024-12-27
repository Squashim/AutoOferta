<x-app-layout>
    <section
        class="mx-auto mb-16 mt-4 max-w-4xl rounded-lg bg-gray-100 text-gray-800 shadow-md dark:bg-slate-700 dark:text-white"
    >
        <h1 class="block p-8 text-3xl font-semibold">Edytuj swoją ofertę</h1>

        <form
            action="{{ route('offers.update', $offer->id) }}"
            method="post"
            enctype="multipart/form-data"
            class="flex flex-col gap-16"
        >
            @csrf
            @method('PUT')
            <fieldset class="grid grid-cols-1 gap-4 bg-slate-800 px-8 pb-8 pt-4 sm:grid-cols-3">
                <legend class="rounded-md bg-slate-800 px-4 py-2 text-lg font-medium">1. Dane pojazdu</legend>
                {{-- Dane pojazdu --}}
                <div
                    x-init="init()"
                    x-data="fetchModelsHandler()"
                    class="flex flex-col gap-4 sm:col-span-3 sm:flex-row sm:items-start"
                >
                    {{-- Select z marką --}}
                    <div class="flex w-full flex-col">
                        <x-select
                            :options="$carBrands"
                            :validationName="'carBrand'"
                            :editSelected="$offer->carDetails->carModel->carBrand->slug"
                            :placeholder="'Wybierz markę'"
                            :label="'Marka pojazdu'"
                            x-on:x-select-change="handleBrandChange($event.detail)"
                        />
                        <x-input-error :messages="$errors->get('carBrand')" class="mt-2" />
                    </div>
                    {{-- Select z modelem --}}
                    <div class="flex w-full flex-col">
                        <div
                            class="relative"
                            x-data="{
                                open: false,
                                activeIndex: -1,
                                validationName: 'carModel',
                                placeholder: 'Wybierz model',
                                toggle() {
                                    if (this.open) {
                                        return this.close()
                                    }
                                    this.$refs.button.focus()
                                    this.open = true
                                },
                                close(focusAfter) {
                                    if (! this.open) return
                                    this.open = false
                                    this.activeIndex = -1
                                    focusAfter && focusAfter.focus()
                                },
                                selectOption(index) {
                                    this.selectedModel = models[index].slug
                                    this.close(this.$refs.button)
                                },
                                handleKeydown(event) {
                                    if (! this.open) {
                                        if (event.key === 'Enter') {
                                            this.toggle()
                                        }
                                        return
                                    }
                                    if (event.key === 'ArrowDown') {
                                        this.activeIndex = (this.activeIndex + 1) % models.length
                                    } else if (event.key === 'ArrowUp') {
                                        this.activeIndex =
                                            (this.activeIndex - 1 + models.length) % models.length
                                    } else if (event.key === 'Enter' && this.activeIndex !== -1) {
                                        this.selectOption(this.activeIndex)
                                    } else if (event.key === 'Escape') {
                                        this.close(this.$refs.button)
                                    }
                                },
                            }"
                            x-on:keydown.escape.prevent.stop="close($refs.button)"
                            x-on:keydown.arrow-down.prevent.stop="handleKeydown"
                            x-on:keydown.arrow-up.prevent.stop="handleKeydown"
                            x-on:keydown.enter.prevent.stop="handleKeydown"
                            x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                            x-id="['dropdown-button']"
                        >
                            <label
                                x-bind:for="validationName"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Model pojazdu
                            </label>
                            {{-- Hidden Input --}}
                            <input
                                type="text"
                                class="hidden appearance-none border-none bg-transparent focus:outline-none"
                                x-bind:name="validationName"
                                x-bind:id="validationName"
                                x-bind:value="selectedModel"
                            />
                            <button
                                x-ref="button"
                                type="button"
                                x-bind:disabled="secondDisabled"
                                x-bind:aria-expanded="open"
                                x-bind:aria-controls="$id('dropdown-button')"
                                x-on:click="toggle()"
                                class="mt-1 flex w-full min-w-48 items-center justify-between gap-2 rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:opacity-25 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                            >
                                <span x-text="slugToName(selectedModel) || placeholder"></span>
                                <svg
                                    x-bind:class="{
                                        'rotate-180': open,
                                        'duration-300': true,
                                        'transition-transform': true,
                                    }"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-5 dark:text-gray-300"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m19.5 8.25-7.5 7.5-7.5-7.5"
                                    />
                                </svg>
                            </button>
                            <menu
                                x-show="open"
                                x-ref="panel"
                                x-transition.origin.top.left
                                x-on:click.outside="close($refs.button)"
                                x-bind:id="$id('dropdown-button')"
                                style="display: none"
                                role="menu"
                                class="custom-scroll absolute z-10 mt-2 max-h-56 w-full min-w-48 overflow-y-auto rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            >
                                <template x-for="(option, index) in models" x-bind:key="index">
                                    <li
                                        role="menuitem"
                                        class="cursor-pointer px-4 py-2 transition duration-150 first-of-type:rounded-t-md last-of-type:rounded-b-md hover:bg-indigo-600"
                                        x-bind:class="{
                                            'bg-indigo-600': activeIndex === index || selectedModel === option.slug,
                                        }"
                                        x-on:click="selectOption(index)"
                                        x-on:mouseenter="activeIndex = index"
                                        x-on:mouseleave="activeIndex = -1"
                                        x-text="option.name"
                                    ></li>
                                </template>
                            </menu>
                        </div>
                        <x-input-error :messages="$errors->get('carModel')" class="mt-2" />
                    </div>
                </div>
                {{-- VIN --}}
                <div>
                    <x-input-label for="vin" value="Numer VIN" />
                    <x-text-input
                        id="vin"
                        value="{{old('vin', $offer->carDetails->vin)}}"
                        placeholder="WAUZZZ8T9AA004039"
                        pattern="^[S-Z][A-HJ-NPR-Z0-9]{12}[0-9]{4}$"
                        title="Podaj poprawny numer VIN np. WAUZZZ8T9AA004039"
                        class="span- mt-1 block w-full"
                        type="text"
                        name="vin"
                        required
                    />
                    <x-input-error :messages="$errors->get('vin')" class="mt-2" />
                </div>
                {{-- Przebieg --}}
                <div>
                    <x-input-label for="mileage" value="Przebieg [km]" />
                    <x-text-input
                        id="mileage"
                        class="mt-1 block w-full"
                        type="text"
                        value="{{old('mileage', $offer->carDetails->mileage)}}"
                        name="mileage"
                        placeholder="198020"
                        title="Podaj przebieg w zakresie od 1 do 1 000 000"
                        required
                        maxLength="7"
                    />
                    <x-input-error :messages="$errors->get('mileage')" class="mt-2" />
                </div>
                {{-- Rok produkcji --}}
                <div>
                    <x-input-label for="prod_year" value="Rok produkcji" />
                    <x-text-input
                        id="prod_year"
                        class="mt-1 block w-full"
                        type="number"
                        value="{{old('prod_year', $offer->carDetails->prod_year)}}"
                        name="prod_year"
                        min="1900"
                        max="2024"
                        placeholder="2012"
                        title="Podaj rok w odpowiedniej formule YYYY"
                        required
                    />
                    <x-input-error :messages="$errors->get('prod_year')" class="mt-2" />
                </div>
            </fieldset>

            {{-- Szczegolowe informacje --}}
            <fieldset class="grid grid-cols-1 gap-4 bg-slate-800 px-8 pb-8 pt-4 md:grid-cols-4">
                <legend class="rounded-md bg-slate-800 px-4 py-2 text-lg font-medium">2. Szczegółowe informacje</legend>
                {{-- Rodzaj nadwozia --}}
                <div class="md:col-span-2">
                    <x-select
                        :options="$carTypes"
                        :editSelected="$offer->carDetails->car_type"
                        :placeholder="'Wybierz typ nadwozia'"
                        :validationName="'car_type'"
                        :label="'Typ nadwozia'"
                    ></x-select>
                    <x-input-error :messages="$errors->get('car_type')" class="mt-2" />
                </div>
                {{-- Rodzaj napędu --}}
                <div>
                    <x-select
                        :options="$driveTypes"
                        :editSelected="$offer->carDetails->drive_type"
                        :placeholder="'Wybierz napęd'"
                        :validationName="'drive_type'"
                        :label="'Rodzaj napędu'"
                    ></x-select>
                    <x-input-error :messages="$errors->get('drive_type')" class="mt-2" />
                </div>

                {{-- Typ paliwa --}}
                <div>
                    <x-select
                        :options="$fuelTypes"
                        :editSelected="$offer->carDetails->fuel_type"
                        :placeholder="'Wybierz paliwo'"
                        :validationName="'fuel_type'"
                        :label="'Rodzaj paliwa'"
                    ></x-select>
                    <x-input-error :messages="$errors->get('fuel_type')" class="mt-2" />
                </div>

                {{-- Skrzynia biegow --}}
                <div class="md:col-span-2">
                    <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Skrzynia biegów</span>
                    <div
                        class="mt-1 flex w-full items-center justify-evenly gap-8 rounded-md border border-gray-300 bg-slate-800 px-4 py-2 shadow-sm dark:border-gray-700 dark:bg-gray-900"
                    >
                        <x-radio
                            :label="'Manualna'"
                            :nameGroup="'transmission'"
                            :value="'manual'"
                            :checked="old('transmission', $offer->carDetails->transmission) === 'manual'"
                        />

                        <x-radio
                            :label="'Automatyczna'"
                            :nameGroup="'transmission'"
                            :value="'automatic'"
                            :checked="old('transmission', $offer->carDetails->transmission) === 'automatic'"
                        />
                    </div>
                </div>

                {{-- Pojemność skokowa --}}
                <div>
                    <x-input-label for="engine_capacity" value="Pojemność skokowa [cm/3]" />
                    <x-text-input
                        id="engine_capacity"
                        class="mt-1 block w-full"
                        type="number"
                        value="{{old('engine_capacity', $offer->carDetails->engine_capacity)}}"
                        name="engine_capacity"
                        min="600"
                        max="6000"
                        placeholder="1999"
                        title="Podaj pojemność silnika w zakresie 600 - 6 000 [cm\3]"
                        required
                    />
                    <x-input-error :messages="$errors->get('engine_capacity')" class="mt-2" />
                </div>

                {{-- Moc silnika --}}
                <div>
                    <x-input-label for="engine_power" value="Moc silnika [KM]" />
                    <x-text-input
                        id="engine_power"
                        class="mt-1 block w-full"
                        type="number"
                        value="{{old('engine_power', $offer->carDetails->engine_power)}}"
                        name="engine_power"
                        min="20"
                        max="2000"
                        placeholder="150"
                        title="Podaj pojemność silnika w zakresie 20 - 2 000 [KM]"
                        required
                    />
                    <x-input-error :messages="$errors->get('engine_power')" class="mt-2" />
                </div>

                {{-- Cena --}}
                <div class="md:col-span-2">
                    <x-input-label for="price" value="Cena pojazdu [zł]" />
                    <x-text-input
                        id="price"
                        class="mt-1 block w-full"
                        type="text"
                        name="price"
                        value="{{old('price', $offer->price)}}"
                        placeholder="21000"
                        title="Podaj cenę w zł"
                        minLength="1"
                        maxLength="8"
                        required
                    />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

                {{-- Kolor --}}
                <div>
                    <x-input-label for="color" value="Kolor pojazdu" />
                    <x-text-input
                        id="color"
                        class="mt-1 block w-full"
                        type="text"
                        name="color"
                        value="{{old('color', $offer->carDetails->color)}}"
                        placeholder="Granatowy"
                        title="Podaj pełną nazwę koloru"
                        minLength="3"
                        maxLength="20"
                        required
                    />
                    <x-input-error :messages="$errors->get('color')" class="mt-2" />
                </div>

                {{-- Stan --}}
                <div>
                    <x-select
                        :options="$vehicleConditions"
                        :editSelected="$offer->carDetails->car_condition"
                        :placeholder="'Wybierz stan'"
                        :validationName="'car_condition'"
                        :label="'Stan pojazdu'"
                    ></x-select>
                    <x-input-error :messages="$errors->get('car_condition')" class="mt-2" />
                </div>

                {{-- Opis --}}
                <div class="mb-8 md:col-span-4 md:row-span-2">
                    <x-input-label for="description" value="Dodatkowy opis" />
                    <textarea
                        name="description"
                        id="description"
                        minlength="10"
                        maxlength="500"
                        title="Wprowadź opis ogłoszenia do 500 znaków"
                        placeholder="Maksymalnie 500 znaków"
                        rows="4"
                        class="custom-scroll mt-1 w-full resize-none overflow-y-scroll rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-indigo-600"
                    >
{{ old('description', $offer->description) }}</textarea
                    >
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </fieldset>

            {{-- Dodawanie zdjęć --}}
            <fieldset class="w-full space-y-4 bg-slate-800 px-8 pb-8 pt-4">
                <legend class="rounded-md bg-slate-800 px-4 py-2 text-lg font-medium">3. Dodawanie zdjęć</legend>
                <div class="grid grid-cols-4 items-center gap-4">
                    <label
                        for="photos"
                        class="col-span-2 flex w-full max-w-fit cursor-pointer items-center gap-2 rounded-lg bg-white px-6 py-2 text-gray-800 transition duration-300 hover:bg-gray-200 hover:text-gray-700"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                            <!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                fill="rgb(31 41 55)"
                                d="M149.1 64.8L138.7 96 64 96C28.7 96 0 124.7 0 160L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64l-74.7 0L362.9 64.8C356.4 45.2 338.1 32 317.4 32L194.6 32c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z"
                            />
                        </svg>
                        Dodaj zdjęcia
                    </label>
                    <span id="image-count" class="col-span-2 text-right">Liczba zdjęć: 0</span>
                    <input
                        type="file"
                        name="photos[]"
                        id="photos"
                        accept="image/x-png,image/jpg,image/jpeg,image/webp"
                        title="Dozwolone formaty zdjęć to: jpeg, jpg, png."
                        multiple
                        onchange="previewImages(event)"
                        required
                        class="hidden"
                    />
                    <div
                        class="col-span-2 flex flex-col gap-3 rounded-md border border-amber-400 bg-amber-500/20 p-4 text-sm"
                        role="alert"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            class="size-6 stroke-white"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"
                            />
                        </svg>

                        <p>
                            UWAGA!! Ponowne przesłanie formularza z nowymi zdjęciami usunie wszystkie poprzednio dodane
                            zdjęcia do oferty!!
                        </p>
                    </div>
                    <div
                        class="col-span-2 flex flex-col gap-3 rounded-md border border-sky-400 bg-sky-500/20 p-4 text-sm"
                        role="alert"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            class="size-6 stroke-white"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"
                            />
                        </svg>
                        <p>
                            <span class="font-semibold">Zdjęcia należy dodać jednocześnie.</span>
                            Wymagane od 2 do 5 zdjęć. W celu zmiany zdjęć trzeba je ponownie przesłać.
                        </p>
                    </div>
                </div>
                <div id="image-preview-container" class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                    @foreach ($offer->images as $index => $image)
                        <div
                            data-index="{{ $index }}"
                            class="image-preview-placeholder relative flex min-h-[240px] items-center justify-center rounded-lg bg-slate-700"
                        >
                            <img
                                src="{{ asset('storage/' . $image->path) }}"
                                alt="Ofeta {{ $offer->carDetails->carModel->carBrand->name }} {{ $offer->carDetails->carModel->name }}-{{ $image->id }}"
                                class="h-full w-full rounded-lg bg-slate-700 object-contain"
                            />
                        </div>
                    @endforeach
                </div>

                <x-input-error :messages="$errors->get('photos')" class="mt-2" />
            </fieldset>

            {{-- Dodatkowe wyposazenie --}}
            <fieldset class="w-full space-y-4 bg-slate-800 px-8 pb-8 pt-4">
                <legend class="rounded-md bg-slate-800 px-4 py-2 text-lg font-medium">4. Dodatkowe wyposażenie</legend>
                <x-accordion.group>
                    @foreach ($featureCategories as $category)
                        <x-accordion.item :label="$category->category_name">
                            @foreach ($category->features as $feature)
                                <x-checkbox
                                    :id="$feature->slug"
                                    :name="'car_features['. $category->slug. '][]'"
                                    :label="$feature->feature_name"
                                    :value="$feature->slug"
                                    :checked="in_array(
                                        $feature->slug,
                                        old('car_features.' . $category->slug,
                                        $offer->carDetails->features->where('category_id', $category->id)->pluck('slug')->toArray() ?? [])
                                    )"
                                />
                            @endforeach
                        </x-accordion.item>
                    @endforeach
                </x-accordion.group>
            </fieldset>

            {{-- Dane sprzedajacego --}}
            <fieldset class="w-full space-y-4 bg-slate-800 px-8 pb-8 pt-4">
                <legend class="rounded-md bg-slate-800 px-4 py-2 text-lg font-medium">5. Dane sprzedającego</legend>
                <div class="flex gap-4">
                    {{-- Numer telefonu --}}
                    <div>
                        <x-input-label for="phone" value="Telefon kontaktowy" />
                        <x-text-input
                            id="phone"
                            class="mt-1 block w-full"
                            type="tel"
                            name="phone"
                            value="{{old('phone', $offer->phone)}}"
                            placeholder="514283794"
                            title="Podaj numer telefonu jako 9 cyfr"
                            pattern="[0-9]{9}"
                            required
                        />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                    {{-- Miasto sprzedaży --}}
                    <div>
                        <x-input-label for="city" value="Miasto sprzedaży" />
                        <x-text-input
                            id="city"
                            class="mt-1 block w-full"
                            type="text"
                            name="city"
                            value="{{old('city', $offer->city)}}"
                            placeholder="Warszawa"
                            title="Podaj nazwę miasta"
                            minlength="3"
                            maxlength="100"
                            required
                        />
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>
                </div>
            </fieldset>

            {{-- Przyciski obslugi formularza --}}
            <div class="fixed bottom-0 left-0 w-full bg-gray-100 py-4 shadow-md dark:bg-zinc-900">
                <div class="mx-auto flex max-w-4xl gap-4 px-8">
                    <x-button
                        type="button"
                        onClick="window.location.href='{{route('dashboard.offers')}}'"
                        style="secondary"
                    >
                        Anuluj
                    </x-button>
                    <x-button type="submit" style="primary">Edytuj ofertę</x-button>
                </div>
            </div>
        </form>
    </section>
</x-app-layout>

<script>
    // Funkcja do obsługi selecta z odpowiednimi modelami dla marki
    function fetchModelsHandler() {
        return {
            // Wybrany model i marka - pobierany ze starej wartości formularza w PHP/Laravel
            selectedModel: {!! json_encode(old('carModel', $offer->carDetails->carModel->slug)) !!},
            selectedBrand: {!! json_encode(old('carBrand', $offer->carDetails->carModel->carBrand->slug)) !!},

            // Flaga, która kontroluje, czy pole wyboru modelu jest zablokowane
            secondDisabled: true,
            // Tablica przechowująca dostępne modele dla wybranej marki
            models: [],

            // Asynchroniczna funkcja do pobierania modeli na podstawie slug-a marki
            async fetchModels(brandSlug) {
                // Reset wartości na domyślne
                this.secondDisabled = true;
                this.models = [];

                try {
                    const response = await fetch(`/api/get-models?slug=${brandSlug}`);
                    const data = await response.json();

                    if (data.error) {
                        return;
                    }

                    this.models = data;
                    this.secondDisabled = false;
                } catch (error) {
                    console.error(error);
                }
            },
            // Funkcja konwertująca nazwę (np. "Example Name") na slug (np. "example-name")
            nameToSlug(name) {
                return name
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            },
            // Funkcja konwertująca slug (np. "example-name") na czytelną nazwę (np. "Example Name")
            slugToName(slug) {
                if (!slug) return '';
                return slug
                    .replace(/-/g, ' ')
                    .replace(/\s+/g, ' ')
                    .trim()
                    .replace(/\b\w/g, (char) => char.toUpperCase());
            },
            // Funkcja inicjalizująca, wywoływana przy załadowaniu komponentu
            init() {
                // Jeśli jest wybrana marka, pobieramy modele dla tej marki
                if (this.selectedBrand) {
                    this.fetchModels(this.nameToSlug(this.selectedBrand));
                }
            },
            // Funkcja obsługująca zmianę wybranej marki
            handleBrandChange(brandSlug) {
                // Ustawiamy nową wybraną markę i pobieramy dla niej marki
                this.selectedBrand = brandSlug;
                this.fetchModels(brandSlug);

                // Sprawdzamy, czy wybrany wcześniej model istnieje w nowej liście modeli
                if (this.selectedModel) {
                    const modelExists = this.models.some((model) => model.slug === this.selectedModel);
                    // Jeśli model nie istnieje, resetujemy wybór modelu
                    if (!modelExists) {
                        this.selectedModel = '';
                    }
                }
            },
        };
    }

    // Tworzenie kontenera dla zdjecia
    function createEmptyImagePlaceholder(id) {
        const placeholder = document.createElement('div');
        placeholder.classList =
            'image-preview-placeholder flex items-center justify-center rounded-lg bg-slate-700 opacity-70 min-h-[240px]';
        placeholder.dataset.index = id;
        placeholder.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512">
                <path
                    fill="rgb(255,255,255)"
                    d="M0 96C0 60.7 28.7 32 64 32l384 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6l96 0 32 0 208 0c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"
                />
            </svg>`;
        return placeholder;
    }

    // Wyswietlanie na stronie kontenetrow od indeksu from
    function displayImagePlaceholders(from) {
        const previewContainer = document.getElementById('image-preview-container');
        const imagesCountContainer = document.getElementById('image-count');
        imagesCountContainer.textContent = `Liczba zdjęć: ${from}`;

        for (let i = from; i < 5; i++) {
            previewContainer.appendChild(createEmptyImagePlaceholder(i));
        }
    }

    // Dodanie zdjec w miejsce pustych miejsc
    function updateImages(files) {
        const previewContainer = document.getElementById('image-preview-container');
        let existingImagesCount = {{ count($offer->images) }};
        let newImagesCount = files.length;

        Array.from(files).forEach((file, index) => {
            const placeholderContainer = previewContainer.querySelector(
                `.image-preview-placeholder[data-index="${index}"]`,
            );

            placeholderContainer.classList.remove('opacity-70');
            placeholderContainer.classList.add('relative');
            placeholderContainer.innerHTML = '';

            const reader = new FileReader();
            reader.onload = function () {
                const img = document.createElement('img');
                img.src = reader.result;
                img.alt = file.name;
                img.classList.add('w-full', 'h-full', 'object-contain', 'bg-slate-700', 'rounded-lg');

                placeholderContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });

        for (let i = newImagesCount; i < 5; i++) {
            const placeholderContainer = previewContainer.querySelector(
                `.image-preview-placeholder[data-index="${i}"]`,
            );
            placeholderContainer.remove();
        }

        displayImagePlaceholders(newImagesCount);
    }

    document.addEventListener('DOMContentLoaded', () => {
        displayImagePlaceholders({{ count($offer->images) }});
    });

    function previewImages(event) {
        const files = event.target.files;
        updateImages(files);
    }
</script>
