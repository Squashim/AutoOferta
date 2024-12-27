<?php

namespace Database\Seeders;

use App\Models\CarDetail;
use App\Models\Feature;
use App\Models\FeatureCategory;
use App\Models\Offer;
use App\Models\OfferImage;
use App\Models\User;
use App\Services\CarDataService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{

    protected $carDataService;

    public function __construct(CarDataService $carDataService)
    {
        $this->carDataService = $carDataService;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fuelTypes = $this->carDataService->getFuelTypes()->pluck('slug')->toArray();
        $driveTypes = $this->carDataService->getDriveTypes()->pluck('slug')->toArray();
        $vehicleConditions = $this->carDataService->getVehicleConditions()->pluck('slug')->toArray();
        $carTypes = $this->carDataService->getCarTypes()->pluck('slug')->toArray();

        $featureCategories = FeatureCategory::with('features')->get();

        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('Admin123!'),
            ]
        ];

        $mailEndings = [
            "@gmail.com",
            "@wp.pl",
            "@o2.pl",
            "@outlook.com",
            "@yahoo.com",
            "@icloud.com",
            "@interia.pl",
            "@onet.pl",
            "@prokonto.pl",
            "@gazeta.pl",
            "@poczta.onet.pl",
            "@poczta.fm",
        ];

        $cities = ["Warszawa", "Kraków", "Gdańsk", "Wrocław", "Poznań", "Łódź", "Lublin", "Szczecin", "Bydgoszcz", "Białystok", "Szczecin", "Bytom", "Kraśnik"];

        $userNames = ["Aleksandra", "Magdalena", "Krzysztof", "Maria", "Tomasz", "Katarzyna", "Piotr", "Agnieszka", "Michał", "Małgorzata", "Andrzej", "Włodzimierz", "Łukasz", "Arkadiusz", "Maciej", "Konrad", "Mateusz", "Jakub"];

        $engine_power = [
            95,
            367,
            150,
            150,
            182,
            140,
            122,
            177,
            100,
            190,
            150,
            286,
            70,
            140,
            265,
            82,
            101,
            170,
            190,
            105,
            306,
            122,
            180,
            150
        ];

        $engine_capacity = [
            999,
            2989,
            1968,
            1499,
            1499,
            1968,
            1395,
            1591,
            1199,
            1984,
            3449,
            2967,
            1198,
            1968,
            1984,
            1199,
            1595,
            1996,
            1950,
            1896,
            1998,
            1390,
            1781,
            1997
        ];

        $transmission = [
            "automatic",
            "automatic",
            "manual",
            "manual",
            "automatic",
            "manual",
            "automatic",
            "automatic",
            "manual",
            "automatic",
            "automatic",
            "automatic",
            "manual",
            "manual",
            "automatic",
            "manual",
            "manual",
            "automatic",
            "automatic",
            "manual",
            "automatic",
            "manual",
            "manual",
            "automatic"
        ];

        $car_condition = [
            "used",
            "new",
            "used",
            "used",
            "used",
            "used",
            "used",
            "used",
            "new",
            "new",
            "used",
            "used",
            "used",
            "used",
            "used",
            "used",
            "used",
            "new",
            "used",
            "used",
            "used",
            "used",
            "used",
            "used"
        ];

        $fuel_type = [
            "benzyne",
            "diesel",
            "diesel",
            "benzyne",
            "benzyne",
            "diesel",
            "benzyne",
            "benzyne",
            "benzyne",
            "benzyne",
            "diesel",
            "diesel",
            "benzyne",
            "diesel",
            "benzyne",
            "benzyne",
            "benzyne_lpg",
            "diesel",
            "diesel",
            "diesel",
            "benzyne",
            "benzyne",
            "benzyne",
            "diesel"
        ];

        $drive_type = [
            "fwd",
            "4wd",
            "fwd",
            "fwd",
            "awd",
            "fwd",
            "fwd",
            "fwd",
            "fwd",
            "fwd",
            "rwd",
            "awd",
            "fwd",
            "fwd",
            "awd",
            "fwd",
            "fwd",
            "awd",
            "rwd",
            "fwd",
            "rwd",
            "fwd",
            "awd",
            "fwd"
        ];

        $car_type = [
            "small",
            "suv",
            "minivan",
            "minivan",
            "minivan",
            "minivan",
            "compact",
            "suv",
            "suv",
            "compact",
            "sedan",
            "suv",
            "compact",
            "minivan",
            "kombi",
            "small",
            "kombi",
            "kombi",
            "minivan",
            "compact",
            "small",
            "compact",
            "sedan",
            "kombi"
        ];

        $mileage = [
            141000,
            1,
            237590,
            103000,
            190000,
            202000,
            174000,
            70000,
            1,
            4892,
            290500,
            182836,
            174950,
            177316,
            6138,
            35000,
            282000,
            1,
            146000,
            391000,
            152500,
            229000,
            300000,
            171000
        ];

        $description = [
            "Audi A1 Rok prod 2015 poj 999cm automat przebieg 141000km ksiazka serwisowa stan b dobry",
            "Nowy Mercedes GLE to luksusowy SUV oferujący elegancki design, zaawansowane technologie, przestronne wnętrze i dynamiczne jednostki napędowe. Idealny dla wymagających kierowców ceniących komfort i prestiż.",
            "Volkswagen Caddy 2.0 TDI Comfortline to wszechstronny i ekonomiczny van, idealny do rodzinnych podróży lub biznesowych zastosowań. Oferuje przestronne wnętrze, nowoczesne technologie oraz dynamiczny, oszczędny silnik diesla.",
            "Ford C-MAX 1.5 EcoBoost Titanium ASS to kompaktowy van łączący dynamikę z komfortem. Wyposażony w nowoczesny silnik benzynowy EcoBoost, bogate wyposażenie Titanium i system Start-Stop, zapewnia wygodę i oszczędność w codziennej jeździe",
            "Ford Escape 1.5 EcoBoost AWD SE to kompaktowy SUV z napędem na cztery koła, oferujący wszechstronność i komfort. Wyposażony w oszczędny silnik EcoBoost, nowoczesne technologie i przestronne wnętrze, idealnie sprawdza się w mieście i poza nim.",
            "Volkswagen Touran 2.0 TDI DPF BlueMotion Technology Highline to przestronny minivan z oszczędnym silnikiem diesla, nowoczesnymi technologiami i bogatym wyposażeniem. Idealny dla rodzin, oferuje komfort, funkcjonalność i niskie zużycie paliwa.",
            "Audi A3 1.4 TFSI Edycja Specjalna S tronic to stylowy hatchback łączący dynamiczny silnik benzynowy z płynną automatyczną skrzynią biegów. Wyróżnia się eleganckim designem, wysokiej jakości wykończeniem i nowoczesnymi technologiami, zapewniając wyjątkowy komfort jazdy.",
            "Hyundai Tucson 1.6 GDi 2WD DCT Premium to elegancki SUV z bogatym wyposażeniem i dynamicznym silnikiem benzynowym o mocy 177 KM. Wyposażony w automatyczną skrzynię biegów, systemy wspomagania kierowcy, nawigację oraz panoramiczny dach. Samochód bezwypadkowy, w doskonałym stanie technicznym i wizualnym, idealny zarówno do miasta, jak i na dłuższe trasy.",
            "Opel Mokka 1.2 T Edition S&S to kompaktowy SUV, który łączy nowoczesny styl z zaawansowaną technologią. Wyposażony w dynamiczny silnik benzynowy z systemem Start&Stop, oferuje płynną jazdę, oszczędność paliwa i świetne osiągi. Jego wyrazista stylistyka, przestronne i ergonomiczne wnętrze oraz bogaty zestaw funkcji wspierających kierowcę sprawiają, że to idealny wybór dla osób ceniących wygodę, bezpieczeństwo i nowoczesne rozwiązania w codziennym użytkowaniu.",
            "Volkswagen Arteon 2.0 TSI R-Line DSG to elegancki samochód klasy wyższej produkowany przez niemieckiego producenta Volkswagen. Wersja ta charakteryzuje się mocnym silnikiem benzynowym 2.0 TSI o mocy 190 KM, współpracującym z 7-biegową automatyczną skrzynią biegów DSG. Model R-Line wyróżnia się sportowym wyglądem i bogatym wyposażeniem.",
            "Mercedes-Benz Klasa S 350 TD to model z serii S, produkowanej przez niemiecką markę Mercedes-Benz, który łączy luksus, technologię oraz komfort. Jest to wersja z silnikiem wysokoprężnym (TD), co zapewnia dobrą dynamikę przy jednoczesnej oszczędności paliwa.",
            "Audi Q7 50 TDI Quattro Tiptronic to luksusowy SUV, który łączy potężny silnik, napęd na cztery koła oraz zaawansowaną technologię. Jest to wersja wyposażona w silnik diesla 3.0 TDI, która zapewnia doskonałą moc oraz świetne właściwości jezdne w różnych warunkach.",
            "Volkswagen Polo 1.2 MATCH to wersja popularnego, kompaktowego hatchbacka, oferująca odpowiednią równowagę między ekonomicznością, komfortem a funkcjonalnością. Wersja MATCH to wyższa specyfikacja, która zazwyczaj obejmuje dodatkowe wyposażenie i atrakcyjny design.",
            "Volkswagen Sharan 2.0 TDI Comfortline to przestronny minivan, który doskonale sprawdza się w roli samochodu rodzinnego lub pojazdu przeznaczonego do przewozu większej liczby pasażerów. Wersja Comfortline charakteryzuje się wyższym poziomem wyposażenia, zapewniającym większy komfort i funkcjonalność.",
            "Audi A6 to luksusowy samochód klasy średniej-wyższej, który łączy elegancki design, nowoczesne technologie i komfort. Dostępny jest w różnych wersjach nadwoziowych (sedan i Avant – wersja kombi) oraz z różnymi silnikami, w tym benzynowymi, dieslowymi i hybrydowymi. Audi A6 jest jednym z flagowych modeli marki i jest znane z wysokiej jakości wykończenia, zaawansowanych systemów bezpieczeństwa oraz komfortu jazdy.",
            "Peugeot 208 1.2 PureTech Access to wersja bazowa popularnego modelu 208, oferująca nowoczesne technologie w przystępnej cenie. Jest to kompaktowy samochód miejski, który łączy funkcjonalność z niskim zużyciem paliwa, co czyni go dobrym wyborem do codziennych dojazdów. Wersja Access to podstawowa konfiguracja, jednak nadal zapewnia szereg istotnych elementów wyposażenia.",
            "Audi A4 Avant 1.6 to wersja popularnego modelu Audi A4 w nadwoziu kombi, łącząca elegancki design, przestronność i funkcjonalność. Jest to samochód o dosyć oszczędnym silniku, co czyni go odpowiednim wyborem dla osób poszukujących komfortu i efektywności paliwowej, szczególnie w wersji 1.6 TDI lub 1.6 FSI, w zależności od wersji napędowej.",
            "Ford Tourneo Custom 2.0 EcoBlue 320 AWD L2 Titanium to przestronny van o eleganckim wyglądzie i zaawansowanej technologii. Wyposażony w 2.0-litrowy silnik EcoBlue o mocy 170 KM, napęd na wszystkie koła (AWD) i automatyczną skrzynię biegów, zapewnia doskonałe osiągi oraz komfort jazdy w różnych warunkach. Wersja L2 oferuje dodatkową przestronność, a wykończenie Titanium gwarantuje wysokiej jakości materiały i nowoczesne technologie, w tym systemy wspomagania kierowcy oraz multimedialne udogodnienia. Idealny zarówno do użytku rodzinnego, jak i biznesowego.",
            "Mercedes-Benz Klasa V 250 d 9G-Tronic to luksusowy van, który łączy elegancję, przestronność i nowoczesną technologię. Wyposażony w 2.0-litrowy silnik diesla o mocy 190 KM, oferuje dynamiczną jazdę i komfort na najwyższym poziomie. 9-biegowa automatyczna skrzynia biegów 9G-Tronic zapewnia płynne i efektywne zmiany biegów. Klasa V 250 d to przestronny pojazd z dużą ilością miejsca na pasażerów i bagaż, idealny do długich podróży. Dodatkowo, oferuje zaawansowane systemy bezpieczeństwa oraz komfortowe wykończenie wnętrza, co czyni go doskonałym wyborem do użytku rodzinnego lub biznesowego.",
            "Volkswagen Golf V 1.9 TDI Comfortline to popularna wersja kompaktowego hatchbacka, znana ze swojej niezawodności i ekonomicznego charakteru. Model wyposażony jest w 1.9-litrowy silnik diesla o mocy około 105 KM, który oferuje dobry balans między osiągami a oszczędnością paliwa. Komfortowa wersja Comfortline zapewnia m.in. przyzwoite wyposażenie wnętrza, takie jak klimatyzację, system audio, elektrycznie sterowane szyby oraz tapicerkę materiałową. Golf V 1.9 TDI jest ceniony za przestronność, solidność wykonania i przystępne koszty eksploatacji. Jest to jeden z tych samochodów, które łączą praktyczność z trwałością.",
            "BMW Seria 1 M135i xDrive to sportowa wersja kompaktowego hatchbacka z napędem na wszystkie koła. Wyposażona w 2.0-litrowy silnik turbo o mocy 306 KM, przyspiesza do 100 km/h w 4,8 sekundy. Oferuje dynamiczną jazdę, precyzyjne prowadzenie i nowoczesne technologie, takie jak system multimedialny, Apple CarPlay, Android Auto oraz liczne systemy wspomagania bezpieczeństwa.",
            "Volkswagen Golf 1.4 TSI Comfortline to kompaktowy samochód z 1.4-litrowym silnikiem turbo o mocy około 150 KM, który oferuje dobre osiągi oraz oszczędność paliwa. Model Comfortline charakteryzuje się bogatym wyposażeniem, w tym systemem multimedialnym, klimatyzacją, tempomatem oraz zaawansowanymi systemami bezpieczeństwa. Jego dynamiczne prowadzenie, przestronna kabina i wysoka jakość wykonania sprawiają, że jest to popularny wybór wśród użytkowników szukających komfortu i funkcjonalności w codziennej jeździe.",
            "Audi A4 1.8T Quattro to luksusowy sedan, który łączy sportowy charakter z elegancją. Wyposażony w 1.8-litrowy silnik turbo o mocy około 190 KM, zapewnia dynamiczną jazdę przy jednoczesnym komforcie. Napęd na cztery koła Quattro gwarantuje doskonałą przyczepność i stabilność, szczególnie w trudniejszych warunkach pogodowych. A4 1.8T Quattro oferuje wysoką jakość wykończenia wnętrza, bogate wyposażenie oraz nowoczesne technologie, sprawiając, że jest to pojazd doskonały zarówno do codziennego użytku, jak i na długie podróże.",
            "Peugeot 308 SW BlueHDi 150 EAT6 Stop & Start GT-Line Edition to przestronny i dynamiczny samochód kombi, który łączy nowoczesny design z zaawansowaną technologią. Wyposażony w silnik 1.6 BlueHDi o mocy 150 KM oraz sześciobiegową automatyczną skrzynię biegów EAT6, zapewnia płynność jazdy oraz oszczędność paliwa. W wersji GT-Line Edition pojazd charakteryzuje się sportowym wyglądem, w tym eleganckimi detalami wykończenia wnętrza oraz zewnętrznymi akcentami, jak 17-calowe felgi aluminiowe i reflektory LED. System Stop & Start poprawia efektywność paliwową, a zaawansowane systemy wspomagania kierowcy zwiększają komfort i bezpieczeństwo jazdy."
        ];

        $phone = [
            695370816,
            731095222,
            698083103,
            500014592,
            601908048,
            603800007,
            691912515,
            500064592,
            691210281,
            455056188,
            531500057,
            738760555,
            602350112,
            662029082,
            225124299,
            735333743,
            502304391,
            573506966,
            714500200,
            662696874,
            882615770,
            691492127,
            854734666,
            314264761

        ];

        $price = [
            48000,
            515361,
            60000,
            44900,
            55000,
            40000,
            43900,
            78900,
            102900,
            211000,
            23500,
            170000,
            19999,
            43900,
            259900,
            27500,
            6999,
            320287,
            199900,
            10300,
            152500,
            19900,
            24999,
            35900

        ];

        $color = [
            "Biały",
            "Zielony",
            "Biały",
            "Granatowy",
            "Czerwony",
            "Srebrny",
            "Srebrny",
            "Czarny",
            "Zielony",
            "Biały",
            "Granatowy",
            "Srebrny",
            "Czarny",
            "Srebrny",
            "Czarny",
            "Srebrny",
            "Czarny",
            "Niebieski",
            "Czarny",
            "Srebrny",
            "Szary",
            "Szary",
            "Niebieski",
            "Biały"
        ];

        $prod_year = [
            2015,
            2024,
            2015,
            2016,
            2014,
            2015,
            2013,
            2018,
            2024,
            2023,
            1996,
            2019,
            2012,
            2013,
            2024,
            2017,
            1999,
            2024,
            2019,
            2007,
            2020,
            2009,
            1998,
            2015
        ];

        $vin = [
            "WAUZZZGB9SR011812",
            "W1NFD3DB3SB273381",
            "WV2ZZZ2KZGX038756",
            "WF0AXXVFG0X051246",
            "SFMCU9JX1EUB77220",
            "WVGZZZ1TZFW079210",
            "WAUZZZ8V5DA046512",
            "TMAJXXVFG0XX64128",
            "VSSZZZKL9SR017370",
            "WVWZZZ3HZPE012933",
            "WDB1401341A306926",
            "WAUZZZ4M8KD039152",
            "WVWZZZ6RZDY072672",
            "WVWZZZ1KZCW000000",
            "WAUZZZF25RN007436",
            "VF3CAHMZ6HW079195",
            "WAUZZZ8DZXA230726",
            "SFADP3F22JL123456",
            "W1V44781513694349",
            "WVWZZZ1KZ8P029716",
            "WBA7L110707G70775",
            "WVWZZZ1KZAP072805",
            "WAUZB48K97A123456",
            "VF3CDBHYF0J056789"
        ];

        $car_model_id = [
            315,
            178,
            65,
            246,
            256,
            109,
            317,
            466,
            557,
            60,
            188,
            338,
            96,
            101,
            321,
            381,
            318,
            305,
            190,
            74,
            132,
            74,
            318,
            389
        ];


        foreach ($userNames as $name) {
            $password = ucfirst($name) . "123!";
            $users[] = [
                'name' => $name,
                'email' => strtolower($name) . $mailEndings[array_rand($mailEndings)],
                'password' => bcrypt($password),
            ];
        }



        // Tworzenie ofert i wszystkich danych powiązanych z nimi
        foreach ($users as $index => $userData) {
            $user = User::create($userData);

            $offerCount = $index === 0 ? 6 : 1;

            for ($i = 0; $i < $offerCount; $i++) {
                $dataIndex = $index === 0 ? $i : 6 + $index - 1;
                $offer = Offer::create([
                    'user_id' => $user->id,
                    'price' => $price[$dataIndex],
                    'phone' => $phone[$dataIndex],
                    'city' => $cities[array_rand($cities)],
                    'description' => $description[$dataIndex],
                ]);
                // Szczegóły pojazdów
                $carDetails = [
                    'offer_id' => $offer->id,
                    'car_model_id' => $car_model_id[$dataIndex],
                    'vin' => $vin[$dataIndex],
                    'mileage' => $mileage[$dataIndex],
                    'prod_year' => $prod_year[$dataIndex],
                    'car_type' => $car_type[$dataIndex],
                    'drive_type' => $drive_type[$dataIndex],
                    'fuel_type' => $fuel_type[$dataIndex],
                    'car_condition' => $car_condition[$dataIndex],
                    'transmission' => $transmission[$dataIndex],
                    'engine_capacity' => $engine_capacity[$dataIndex],
                    'engine_power' => $engine_power[$dataIndex],
                    'color' => $color[$dataIndex]
                ];

                $carDetail = CarDetail::create($carDetails);


                // Dynamiczne wyposazenie
                foreach ($featureCategories as $category) {
                    $features = $category->features->random(rand(0, max(1, $category->features->count())));
                    if ($features instanceof \Illuminate\Support\Collection) {
                        foreach ($features as $feature) {
                            $carDetail->features()->attach($feature->id);
                        }
                    }
                }

                // Zdjecia
                $sourceFolder = public_path("static_images/{$offer->id}");

                if (File::exists($sourceFolder)) {
                    $images = File::files($sourceFolder);

                    foreach ($images as $image) {
                        $file = new \Illuminate\Http\File($image);

                        $path = Storage::disk('public')->putFile("offer_photos/{$offer->id}", $file);

                        OfferImage::create([
                            'offer_id' => $offer->id,
                            'path' => $path
                        ]);
                    }
                } else {
                    Log::warning("Source folder does not exist for offer ID: {$offer->id}");
                }
            }
        }
    }
}
