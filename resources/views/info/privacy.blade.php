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
            <h1 class="text-3xl font-semibold">Polityka prywatności</h1>
        </header>
        <div class="flex flex-col gap-4 p-4 text-lg">
            <div>
                <h2 class="mb-2 text-2xl font-semibold">1. Wprowadzenie</h2>
                <p class="ml-4">
                    1.1. Niniejsza Polityka Prywatności określa zasady przetwarzania danych osobowych Użytkowników
                    korzystających z serwisu internetowego Auto-oferta.pl ("Serwis").
                </p>
                <p class="ml-4">
                    1.2. Administrator danych osobowych dokłada wszelkich starań, aby zapewnić ochronę prywatności
                    Użytkowników zgodnie z obowiązującymi przepisami prawa, w tym RODO.
                </p>
            </div>

            <div>
                <h2 class="mb-2 text-2xl font-semibold">2. Administrator Danych Osobowych</h2>
                <p class="ml-4">2.1 Administratorem danych osobowych jest fikcyjna firma z fikcyjną siedzibą.</p>
            </div>

            <div>
                <h2 class="mb-2 text-2xl font-semibold">3. Zakres i Cel Przetwarzania Danych</h2>
                <p class="ml-4">3.1. Dane osobowe Użytkowników przetwarzane są w celu:</p>
                <div class="ml-4">
                    <p class="ml-4">- świadczenia usług oferowanych w Serwisie,</p>
                    <p class="ml-4">- realizacji umów zawartych za pośrednictwem Serwisu,</p>
                    <p class="ml-4">- obsługi zgłoszeń i zapytań,</p>
                    <p class="ml-4">- spełnienia obowiązków prawnych ciążących na Administratorze,</p>
                    <p class="ml-4">- marketingu własnych usług (za zgodą Użytkownika).</p>
                </div>
            </div>

            <div>
                <h2 class="mb-2 text-2xl font-semibold">4. Rodzaje Przetwarzanych Danych</h2>
                <p class="ml-4">4.1. Przetwarzamy następujące kategorie danych:</p>
                <div class="ml-4">
                    <p class="ml-4">- dane identyfikacyjne (np. imię, nazwisko),</p>
                    <p class="ml-4">- dane kontaktowe (np. adres e-mail, numer telefonu),</p>
                    <p class="ml-4">- dane dotyczące aktywności w Serwisie (np. historia zamieszczonych ofert).</p>
                </div>
            </div>

            <div>
                <h2 class="mb-2 text-2xl font-semibold">5. Podstawa Prawna Przetwarzania</h2>
                <p class="ml-4">5.1. Dane osobowe przetwarzane są na podstawie:</p>
                <div class="ml-4">
                    <p class="ml-4">- zgody Użytkownika – art. 6 ust. 1 lit. a RODO,</p>
                    <p class="ml-4">- realizacji umowy – art. 6 ust. 1 lit. b RODO,</p>
                    <p class="ml-4">- obowiązku prawnego – art. 6 ust. 1 lit. c RODO,</p>
                    <p class="ml-4">- prawnie uzasadnionego interesu Administratora – art. 6 ust. 1 lit. f RODO.</p>
                </div>
            </div>

            <div>
                <h2 class="mb-2 text-2xl font-semibold">6. Okres Przechowywania Danych</h2>
                <p class="ml-4">
                    6.1. Dane osobowe będą przechowywane przez okres niezbędny do realizacji celów, dla których zostały
                    zebrane, a także zgodnie z obowiązującymi przepisami prawa.
                </p>
            </div>
            <div>
                <h2 class="mb-2 text-2xl font-semibold">7. Prawa Użytkownika</h2>
                <p class="ml-4">7.1. Użytkownik ma prawo do:</p>
                <div class="ml-4">
                    <p class="ml-4">- dostępu do swoich danych,</p>
                    <p class="ml-4">- sprostowania danych,</p>
                    <p class="ml-4">- usunięcia danych ("prawo do bycia zapomnianym"),</p>
                    <p class="ml-4">- ograniczenia przetwarzania,</p>
                    <p class="ml-4">- przenoszenia danych,</p>
                    <p class="ml-4">- wniesienia sprzeciwu wobec przetwarzania danych,</p>
                    <p class="ml-4">- wycofania zgody na przetwarzanie danych w dowolnym momencie.</p>
                </div>
                <p class="ml-4">7.2. W celu realizacji powyższych praw, prosimy o kontakt pod adresem e-mail.</p>
            </div>

            <div>
                <h2 class="mb-2 text-2xl font-semibold">8. Odbiorcy Danych</h2>
                <p class="ml-4">8.1. Dane osobowe mogą być przekazywane:</p>
                <div class="ml-4">
                    <p class="ml-4">
                        podmiotom współpracującym z Administratorem w celu świadczenia usług (np. firmy hostingowe),
                    </p>
                    <p class="ml-4">organom publicznym, jeśli jest to wymagane przepisami prawa.</p>
                </div>
            </div>

            <div>
                <h2 class="mb-2 text-2xl font-semibold">9. Pliki Cookies</h2>
                <p class="ml-4">
                    9.1. Serwis wykorzystuje pliki cookies w celu zapewnienia jego prawidłowego funkcjonowania oraz w
                    celach analitycznych i marketingowych.
                </p>
                <p class="ml-4">
                    9.2. Użytkownik może zarządzać ustawieniami plików cookies za pomocą swojej przeglądarki
                    internetowej.
                </p>
            </div>

            <div>
                <h2 class="mb-2 text-2xl font-semibold">10. Postanowienia Końcowe</h2>
                <p class="ml-4">
                    10.1. Administrator zastrzega sobie prawo do zmiany niniejszej Polityki Prywatności w dowolnym
                    czasie. Zmiany wchodzą w życie w momencie ich opublikowania w Serwisie.
                </p>
                <p class="ml-4">
                    10.2. Wszelkie pytania dotyczące niniejszej Polityki Prywatności należy kierować na adres e-mail.
                </p>
            </div>

            <p class="mb-2 text-2xl font-semibold">Dziękujemy za korzystanie z Auto-oferta.pl!</p>
        </div>
    </section>
</x-guest-layout>
