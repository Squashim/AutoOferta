<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            [
                'slug' => 'apple_carplay',
                'feature_name' => 'Apple CarPlay',
                'category_id' => 1,
            ],
            [
                'slug' => 'android_auto',
                'feature_name' => 'Android Auto',
                'category_id' => 1,
            ],
            [
                'slug' => 'bluetooth_interface',
                'feature_name' => 'Interfejs Bluetooth',
                'category_id' => 1,
            ],
            [
                'slug' => 'hands-free_kit',
                'feature_name' => 'Zestaw głośnomówiący',
                'category_id' => 1,
            ],
            [
                'slug' => 'radio',
                'feature_name' => 'Radio',
                'category_id' => 1,
            ],
            [
                'slug' => 'usb_socket',
                'feature_name' => 'Gniazdo USB',
                'category_id' => 1,
            ],
            [
                'slug' => 'satellite_navigation',
                'feature_name' => 'System nawigacji satelitarnej',
                'category_id' => 1,
            ],
            [
                'slug' => 'internet_access',
                'feature_name' => 'Dostęp do internetu',
                'category_id' => 1,
            ],
            [
                'slug' => 'wireless_charging',
                'feature_name' => 'Ładowanie bezprzewodowe urządzeń',
                'category_id' => 2,
            ],
            [
                'slug' => 'head_up_display',
                'feature_name' => 'Wyświetlacz typu Head-Up',
                'category_id' => 2,
            ],
            [
                'slug' => 'air_conditioning',
                'feature_name' => 'Klimatyzacja',
                'category_id' => 2,
            ],
            [
                'slug' => 'automatic_air_conditioning',
                'feature_name' => 'Klimatyzacja automatyczna',
                'category_id' => 2,
            ],
            [
                'slug' => 'dual_zone_automatic_air_conditioning',
                'feature_name' => 'Klimatyzacja automatyczna, dwustrefowa',
                'category_id' => 2,
            ],
            [
                'slug' => 'three_zone_automatic_air_conditioning',
                'feature_name' => 'Klimatyzacja automatyczna: 3 strefowa',
                'category_id' => 2,
            ],
            [
                'slug' => 'four_zone_automatic_air_conditioning',
                'feature_name' => 'Klimatyzacja automatyczna: 4 lub więcej strefowa',
                'category_id' => 2,
            ],
            [
                'slug' => 'manual_air_conditioning',
                'feature_name' => 'Klimatyzacja manualna',
                'category_id' => 2,
            ],
            [
                'slug' => 'open_roof',
                'feature_name' => 'Otwierany dach',
                'category_id' => 2,
            ],
            [
                'slug' => 'panoramic_roof',
                'feature_name' => 'Dach panoramiczny',
                'category_id' => 2,
            ],
            [
                'slug' => 'second_sunroof',
                'feature_name' => 'Drugi szyberdach szklany - przesuwny i uchylny el.',
                'category_id' => 2,
            ],
            [
                'slug' => 'glass_sunroof_electric',
                'feature_name' => 'Szyberdach szklany - przesuwny i uchylny elektryczny',
                'category_id' => 2,
            ],
            [
                'slug' => 'glass_sunroof_manual',
                'feature_name' => 'Szyberdach szklany - przesuwny i uchylny ręcznie',
                'category_id' => 2,
            ],
            [
                'slug' => 'alcantara_upholstery',
                'feature_name' => 'Tapicerka Alcantara',
                'category_id' => 2,
            ],
            [
                'slug' => 'partially_leather_upholstery',
                'feature_name' => 'Tapicerka częściowo skórzana',
                'category_id' => 2,
            ],
            [
                'slug' => 'fabric_upholstery',
                'feature_name' => 'Tapicerka materiałowa',
                'category_id' => 2,
            ],
            [
                'slug' => 'leather_upholstery',
                'feature_name' => 'Tapicerka skórzana',
                'category_id' => 2,
            ],
            [
                'slug' => 'electric_driver_seat',
                'feature_name' => 'Elektrycznie ustawiany fotel kierowcy',
                'category_id' => 2,
            ],
            [
                'slug' => 'heated_driver_seat',
                'feature_name' => 'Podgrzewany fotel kierowcy',
                'category_id' => 2,
            ],
            [
                'slug' => 'heated_passenger_seat',
                'feature_name' => 'Podgrzewany fotel pasażera',
                'category_id' => 2,
            ],
            [
                'slug' => 'ventilated_front_seats',
                'feature_name' => 'Fotele przednie wentylowane',
                'category_id' => 2,
            ],
            [
                'slug' => 'memory_seating',
                'feature_name' => 'Siedzenie z pamięcią ustawienia',
                'category_id' => 2,
            ],
            [
                'slug' => 'ventilated_rear_seats',
                'feature_name' => 'Fotele tylne wentylowane',
                'category_id' => 2,
            ],
            [
                'slug' => 'front_armrests',
                'feature_name' => 'Podłokietniki - przód',
                'category_id' => 2,
            ],
            [
                'slug' => 'sport_steering_wheel',
                'feature_name' => 'Kierownica sportowa',
                'category_id' => 2,
            ],
            [
                'slug' => 'steering_wheel_shift',
                'feature_name' => 'Zmiana biegów w kierownicy',
                'category_id' => 2,
            ],
            [
                'slug' => 'keyless_entry',
                'feature_name' => 'Keyless entry',
                'category_id' => 2,
            ],
            [
                'slug' => 'keyless_go',
                'feature_name' => 'Keyless Go',
                'category_id' => 2,
            ],
            [
                'slug' => 'heated_windshield',
                'feature_name' => 'Podgrzewana przednia szyba',
                'category_id' => 2,
            ],
            [
                'slug' => 'fast_charging',
                'feature_name' => 'Funkcja szybkiego ładowania',
                'category_id' => 2,
            ],
            [
                'slug' => 'charging_cable',
                'feature_name' => 'Kabel do ładowania',
                'category_id' => 2,
            ],
            [
                'slug' => 'cruise_control',
                'feature_name' => 'Tempomat',
                'category_id' => 2,
            ],
            [
                'slug' => 'adaptive_cruise_control',
                'feature_name' => 'Tempomat adaptacyjny ACC',
                'category_id' => 2,
            ],
            [
                'slug' => 'predictive_cruise_control',
                'feature_name' => 'Tempomat przewidujący PCC',
                'category_id' => 2,
            ],
            [
                'slug' => 'bi_xenon_lights',
                'feature_name' => 'Lampy bi-ksenonowe',
                'category_id' => 2,
            ],
            [
                'slug' => 'xenon_lights',
                'feature_name' => 'Lampy ksenonowe',
                'category_id' => 2,
            ],
            [
                'slug' => 'led_front_lights',
                'feature_name' => 'Lampy przednie w technologii LED',
                'category_id' => 2,
            ],
            [
                'slug' => 'laser_headlights',
                'feature_name' => 'Reflektory laserowe',
                'category_id' => 2,
            ],
            [
                'slug' => 'electric_folding_mirrors',
                'feature_name' => 'Lusterka boczne składane elektrycznie',
                'category_id' => 2,
            ],
            [
                'slug' => 'home_lighting',
                'feature_name' => 'Oświetlenie drogi do domu',
                'category_id' => 2,
            ],
            [
                'slug' => 'sport_suspension',
                'feature_name' => 'Zawieszenie sportowe',
                'category_id' => 2,
            ],
            [
                'slug' => 'air_suspension',
                'feature_name' => 'Zawieszenie pneumatyczne',
                'category_id' => 2,
            ],
            [
                'slug' => 'isofix',
                'feature_name' => 'Isofix (punkty mocowania fotelika dziecięcego)',
                'category_id' => 2,
            ],
            [
                'slug' => 'tow_bar',
                'feature_name' => 'Hak',
                'category_id' => 2,
            ],
            [
                'slug' => 'front_distance_control',
                'feature_name' => 'Kontrola odległości z przodu (przy parkowaniu)',
                'category_id' => 3,
            ],
            [
                'slug' => 'rear_distance_control',
                'feature_name' => 'Kontrola odległości z tyłu (przy parkowaniu)',
                'category_id' => 3,
            ],
            [
                'slug' => 'park_assistant',
                'feature_name' => 'Park Assistant - asystent parkowania',
                'category_id' => 3,
            ],
            [
                'slug' => 'independent_parking_system',
                'feature_name' => 'Niezależny system parkowania',
                'category_id' => 3,
            ],
            [
                'slug' => '360_camera',
                'feature_name' => 'Kamera panoramiczna 360',
                'category_id' => 3,
            ],
            [
                'slug' => 'rear_parking_camera',
                'feature_name' => 'Kamera parkowania tył',
                'category_id' => 3,
            ],
            [
                'slug' => 'blind_spot_assistant',
                'feature_name' => 'Asystent (czujnik) martwego pola',
                'category_id' => 3,
            ],
            [
                'slug' => 'lane_assist',
                'feature_name' => 'Asystent pasa ruchu',
                'category_id' => 3,
            ],
            [
                'slug' => 'distance_control',
                'feature_name' => 'Kontrola odległości od poprzedzającego pojazdu',
                'category_id' => 3,
            ],
            [
                'slug' => 'autonomous_steering',
                'feature_name' => 'Autonomiczny system kierowania',
                'category_id' => 3,
            ],
            [
                'slug' => 'dynamic_cornering_lights',
                'feature_name' => 'Dynamiczne światła doświetlające zakręty',
                'category_id' => 3,
            ],


        ];

        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
}
