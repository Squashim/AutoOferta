<x-guest-layout class="mb-8 mt-8 lg:mt-12 lg:max-w-7xl">
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
    </header>
    <section class="flex flex-col gap-4">
        <header class="flex items-center justify-between rounded-md bg-slate-600 p-4">
            <h1 class="text-3xl font-semibold">Warunki użytkowania</h1>
        </header>
        <div class="flex flex-col gap-4 p-4 text-lg">
            <div>
                <h2 class="mb-2 text-2xl font-semibold">1. Wprowadzenie</h2>
                <p class="ml-4">
                    1.1. Niniejsze warunki użytkowania ("Warunki") określają zasady korzystania z serwisu internetowego
                    Auto-oferta.pl ("Serwis").
                </p>
                <p class="ml-4">
                    1.2. Korzystając z Serwisu, Użytkownik akceptuje niniejsze Warunki w całości. Jeśli Użytkownik nie
                    zgadza się z niniejszymi Warunkami, nie powinien korzystać z Serwisu.
                </p>
            </div>

            <div>
                <h2 class="mb-2 text-2xl font-semibold">2. Definicje</h2>
                <p class="ml-4">
                    2.1. "Serwis" – platforma internetowa umożliwiająca Użytkownikom wystawianie i przeglądanie ofert
                    sprzedaży samochodów.
                </p>
                <p class="ml-4">2.2. "Użytkownik" – osoba fizyczna lub prawna, korzystająca z funkcji Serwisu.</p>
                <p class="ml-4">
                    2.3. "Oferta" – ogłoszenie zamieszczone przez Użytkownika dotyczące sprzedaży samochodu.
                </p>
            </div>

            <div>
                <h2 class="mb-2 text-2xl font-semibold">3. Rejestracja i Konto Użytkownika</h2>
                <p class="ml-4">
                    3.1. Dostęp do pełnej funkcjonalności Serwisu może wymagać rejestracji konta Użytkownika.
                </p>
                <p class="ml-4">
                    3.2. Użytkownik zobowiązuje się do podania prawdziwych i aktualnych danych podczas rejestracji.
                </p>
                <p class="ml-4">
                    3.3. Użytkownik odpowiada za bezpieczeństwo swojego konta oraz za wszelkie działania podejmowane z
                    jego użyciem.
                </p>
            </div>

            <div>
                <h2 class="mb-2 text-2xl font-semibold">4. Zamieszczanie Ofert</h2>
                <p class="ml-4">
                    4.1. Użytkownik może zamieścić Ofertę dotyczącą sprzedaży samochodu po zalogowaniu się na swoje
                    konto.
                </p>
                <p class="ml-4">4.2. Oferty muszą być zgodne z przepisami prawa oraz niniejszymi Warunkami.</p>
                <p class="ml-4">
                    4.3. Zabronione jest zamieszczanie treści wulgarnych, obraźliwych, wprowadzających w błąd lub
                    naruszających prawa innych osób.
                </p>
                <p class="ml-4">
                    4.4. Serwis nie ponosi odpowiedzialności za treść Ofert zamieszczanych przez Użytkowników.
                </p>
            </div>

            <div>
                <h2 class="mb-2 text-2xl font-semibold">5. Obowiązki Użytkownika</h2>
                <p class="ml-4">
                    5.1. Użytkownik zobowiązuje się do korzystania z Serwisu w sposób zgodny z prawem oraz niniejszymi
                    Warunkami.
                </p>
                <p class="ml-4">
                    5.2. Użytkownik zobowiązuje się do niepodejmowania działań mogących zakłócić działanie Serwisu.
                </p>
                <p class="ml-4">5.3. Użytkownik ponosi pełną odpowiedzialność za treści zamieszczane w Serwisie.</p>
            </div>

            <div>
                <h2 class="mb-2 text-2xl font-semibold">6. Prawa i Obowiązki Administratora</h2>
                <p class="ml-4">6.1. Administrator Serwisu ma prawo do:</p>
                <div class="ml-4">
                    <p class="ml-4">- moderacji, edycji lub usunięcia treści niezgodnych z Warunkami,</p>
                    <p class="ml-4">
                        - tymczasowego zawieszenia lub trwałego usunięcia konta Użytkownika w przypadku naruszenia
                        Warunków,
                    </p>
                    <p class="ml-4">- usuwania ofert, komentarzy które naruszają prawa innych osób.</p>
                </div>

                <p class="ml-4">
                    6.2. Administrator dokłada wszelkich starań, aby Serwis działał poprawnie, jednak nie gwarantuje
                    jego nieprzerwanej i bezbłędnej pracy.
                </p>
            </div>

            <div>
                <h2 class="mb-2 text-2xl font-semibold">7. Odpowiedzialność</h2>
                <p class="ml-4">
                    7.1. Serwis działa jako platforma pośrednicząca i nie odpowiada za realizację transakcji między
                    Użytkownikami.
                </p>
                <p class="ml-4">
                    7.2. Administrator nie odpowiada za szkody wynikające z korzystania z Serwisu, chyba że są one
                    wynikiem umyślnego działania Administratora.
                </p>
            </div>

            <div>
                <h2 class="mb-2 text-2xl font-semibold">8. Dane Osobowe i Polityka Prywatności</h2>
                <p class="ml-4">
                    8.1. Dane osobowe Użytkowników są przetwarzane zgodnie z obowiązującymi przepisami prawa oraz
                    Polityką Prywatności dostępną na stronie Serwisu.
                </p>
            </div>

            <div>
                <h2 class="mb-2 text-2xl font-semibold">9. Postanowienia Końcowe</h2>
                <p class="ml-4">
                    9.1. Administrator zastrzega sobie prawo do zmiany niniejszych Warunków w dowolnym czasie. Zmiany
                    wchodzą w życie w momencie ich opublikowania w Serwisie.
                </p>
                <p class="ml-4">
                    9.2. Wszelkie spory związane z korzystaniem z Serwisu będą rozstrzygane przez właściwe sądy polskie.
                </p>
                <p class="ml-4">
                    9.3. W przypadku pytań lub wątpliwości, Użytkownik może skontaktować się z Administratorem.
                </p>
            </div>

            <p class="mb-2 text-2xl font-semibold">Dziękujemy za korzystanie z Auto-oferta.pl!</p>
        </div>
    </section>
</x-guest-layout>
