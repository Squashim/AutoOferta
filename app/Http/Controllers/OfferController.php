<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarBrand;
use App\Models\CarDetail;
use App\Models\CarModel;
use App\Models\Feature;
use App\Models\FeatureCategory;
use App\Models\Offer;
use App\Models\OfferImage;
use Illuminate\Support\Facades\DB;
use App\Services\CarDataService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\Favorite;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class OfferController extends Controller
{

    protected $carDataService;


    public function __construct(CarDataService $carDataService)
    {
        $this->carDataService = $carDataService;
        $this->middleware('auth')->except('show', 'search');
    }

    public function create()
    {
        $fuelTypes = $this->carDataService->getFuelTypes();
        $driveTypes = $this->carDataService->getDriveTypes();
        $vehicleConditions = $this->carDataService->getVehicleConditions();
        $carTypes = $this->carDataService->getCarTypes();
        $featureCategories = FeatureCategory::with('features')->get();

        $carBrands = CarBrand::all();
        return view('offers.create', compact('fuelTypes', 'driveTypes', 'vehicleConditions', 'carTypes', 'carBrands', 'featureCategories'));
    }

    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $validated = $request->validate([
                // Dane pojazdu
                'carBrand' => 'required',
                'carModel' => 'required',
                'mileage' => [
                    'required',
                    'integer',
                    'min:0',
                    'max:1000000'
                ],
                'vin' => [
                    'required',
                    'regex:/^[S-Z][A-HJ-NPR-Z0-9]{12}[0-9]{4}$/',
                    'unique:car_details,vin',
                ],
                'prod_year' => [
                    'required',
                    'integer',
                    'min:1900',
                    'max:2024',
                ],
                // Szczegolowe informacje
                'car_type' => 'required',
                'color' => 'required|alpha|min:3|max:20',
                'fuel_type' => 'required',
                'engine_capacity' => 'required|integer|min:600|max:6000',
                'engine_power' => 'required|integer|min:20|max:2000',
                'drive_type' => 'required',
                'price' => 'required|integer|min:500|max:12000000',
                'car_condition' => 'required',
                'description' => [
                    'required',
                    'string',
                    'min:10',
                    'max:500',
                    'regex:/^[a-zA-Z0-9\s.,!?\\-()ąćęłńóśżźĄĆĘŁŃÓŚŻŹ\n]+$/u'

                ],
                // Dodatkowe wyposazenie
                'car_features' => 'array',
                'car_features.*' => 'array',
                'car_features.*.*' => 'exists:features,slug',

                // Walidacja zdjęć
                'photos' => 'required|array|min:2|max:5',
                'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',

                // Dane sprzedajacego
                'phone' => 'required|numeric|digits:9',
                'city' => 'required|string|alpha|max:100|min:3',
                'terms' => 'accepted'
            ], [
                // Marka
                'carBrand.required' => 'Pole marka jest wymagane.',

                // Model
                'carModel.required' => 'Pole model jest wymagane.',

                // Przebieg
                'mileage.required' => 'Pole przebieg jest wymagane.',
                'mileage.integer' => 'Przebieg musi być liczbą całkowitą.',
                'mileage.min' => 'Przebieg nie może być mniejszy niż 0.',

                // VIN
                'vin.required' => 'Pole VIN jest wymagane.',
                'vin.regex' => 'VIN musi zaczynać się literą (S-Z), zawierać 12 znaków alfanumerycznych i kończyć się 4 cyframi.',
                'vin.unique' => "VIN musi być unikalny. Ten numer istnieje już w bazie danych.",

                // Rok produkcji
                'prod_year.required' => 'Pole rok produkcji jest wymagane.',
                'prod_year.integer' => 'Rok produkcji musi być liczbą całkowitą.',
                'prod_year.min' => 'Rok produkcji nie może być wcześniejszy niż 1900.',
                'prod_year.max' => 'Rok produkcji nie może być z przyszłości.',

                // Typ pojazdu
                'car_type.required' => 'Pole typ pojazdu jest wymagane.',

                // Kolor
                'color.required' => 'Pole kolor jest wymagane.',
                'color.alpha' => 'Pole kolor może zawierać tylko litery.',
                'color.min' => 'Pole kolor musi mieć przynajmniej 3 znaki.',
                'color.max' => 'Pole kolor może mieć maksymalnie 20 znaków.',

                // Typ paliwa
                'fuel_type.required' => 'Pole typ paliwa jest wymagane.',

                // Pojemnosc silnika
                'engine_capacity.required' => 'Pole pojemność silnika jest wymagane.',
                'engine_capacity.integer' => 'Pole pojemność silnika musi być liczbą całkowitą.',
                'engine_capacity.min' => 'Pole pojemność silnika musi wynosić co najmniej 600cm/3.',
                'engine_capacity.max' => 'Pole pojemność silnika może wynosić maksymalnie 6000cm/3.',

                // Moc silnika
                'engine_power.required' => 'Pole moc silnika jest wymagane.',
                'engine_power.integer' => 'Pole moc silnika musi być liczbą całkowitą.',
                'engine_power.min' => 'Pole moc silnika musi wynosić co najmniej 20KM.',
                'engine_power.max' => 'Pole moc silnika może wynosić maksymalnie 2000KM.',

                // Naped
                'drive_type.required' => 'Pole typ napędu jest wymagane.',

                // Cena
                'price.required' => 'Cena jest wymagana.',
                'price.integer' => 'Cena musi być liczbą całkowitą.',
                'price.min' => 'Cena musi być większa niż 500zł.',
                'price.max' => 'Cena musi być mniejsza niż 12000000zł.',

                // Stan
                'car_condition.required' => 'Pole stan samochodu jest wymagane.',

                // Opis
                'description.required' => 'Pole opis jest wymagane.',
                'description.string' => 'Pole opis musi być tekstem.',
                'description.min' => 'Pole opis musi mieć przynajmniej 10 znaków.',
                'description.max' => 'Pole opis może mieć maksymalnie 500 znaków.',
                'description.regex' => 'Pole opis zawiera niedozwolone znaki.',

                // Zdjecia
                'photos.required' => 'Musisz przesłać przynajmniej dwa zdjęcia.',
                'photos.array' => 'Zdjęcia muszą być w formie tablicy.',
                'photos.min' => 'Musisz przesłać przynajmniej dwa zdjęcia.',
                'photos.max' => 'Możesz przesłać maksymalnie pięć zdjęć.',
                'photos.*.image' => 'Każdy przesłany plik musi być obrazem.',
                'photos.*.mimes' => 'Dozwolone formaty zdjęć to: jpeg, jpg, png.',
                'photos.*.max' => 'Każde zdjęcie może mieć maksymalny rozmiar 2048 KB.',

                // Dane sprzedajacego
                'phone.required' => 'Numer telefonu jest wymagany.',
                'phone.numeric' => 'Numer telefonu musi składać się tylko z cyfr.',
                'phone.digits' => 'Numer telefonu musi mieć dokładnie 9 cyfr.',
                'city.required' => 'Miasto jest wymagane.',
                'city.string' => 'Nazwa miasta musi być tekstem.',
                'city.alpha' => 'Nazwa miasta musi składać się tylko z liter.',
                'city.max' => 'Nazwa miasta może mieć maksymalnie 100 znaków.',
                'terms.accepted' => 'Musisz zaakceptować warunki.',
            ]);


            $offer = Offer::create([
                'user_id' => Auth::user()->id,
                'price' => $validated['price'],
                'phone' => $validated['phone'],
                'city' => $validated['city'],
                'description' => $validated['description'],
            ]);

            $carModel = CarModel::where('slug', $validated['carModel'])->firstOrFail();

            if (!$carModel) {
                return response()->json(['error' => 'Invalid car model']);
            }

            $carDetails = CarDetail::create([
                'offer_id' => $offer->id,
                'car_model_id' => $carModel->id,
                'vin' => $validated['vin'],
                'mileage' => $validated['mileage'],
                'prod_year' => $validated['prod_year'],
                'car_type' => $validated['car_type'],
                'drive_type' => $validated['drive_type'],
                'fuel_type' => $validated['fuel_type'],
                'car_condition' => $validated['car_condition'],
                'transmission' => $request->transmission,
                'engine_capacity' => $validated['engine_capacity'],
                'engine_power' => $validated['engine_power'],
                'color' => $validated['color'],
            ]);

            if (!empty($validated['car_features'])) {
                foreach ($validated['car_features'] as $categorySlug => $features) {
                    $featureCategory = FeatureCategory::where('slug', $categorySlug)->firstOrFail();

                    $carFeatures = Feature::whereIn('slug', $features)->where('category_id', $featureCategory->id)->get();

                    foreach ($carFeatures as $feature) {
                        $carDetails->features()->attach($feature->id);
                    }
                }
            }
            if ($request->hasFile('photos')) {
                $manager = new ImageManager(new Driver());

                foreach ($request->file('photos') as $photo) {
                    $image = $manager->read($photo);
                    $image->scale(width: 800);
                    $directory = public_path('storage/offer_photos/' . $offer->id);
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0755, true);
                    }
                    $path = "offer_photos/{$offer->id}/" . uniqid() . '.webp';
                    $image->toWebp(90)->save(public_path('storage/' . $path));

                    OfferImage::create([
                        'offer_id' => $offer->id,
                        'path' => $path,
                    ]);
                }
            }

            DB::commit();

            session()->flash('success', 'Twoja oferta została pomyślnie dodana!');

            return redirect()->route('dashboard.offers');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();

            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::findOrfail($id);

        if (Auth::id() !== $offer->user_id) {
            return redirect()->route("dashboard.offers");
        }

        DB::beginTransaction();
        try {
            $validated = $request->validate([
                // Dane pojazdu
                'carBrand' => 'required',
                'carModel' => 'required',
                'mileage' => [
                    'required',
                    'integer',
                    'min:0',
                    'max:1000000'
                ],
                'vin' => [
                    'required',
                    'regex:/^[S-Z][A-HJ-NPR-Z0-9]{12}[0-9]{4}$/',
                    'unique:car_details,vin,' . $id,
                ],
                'prod_year' => [
                    'required',
                    'integer',
                    'min:1900',
                    'max:2024',
                ],
                // Szczegolowe informacje
                'car_type' => 'required',
                'color' => 'required|alpha|min:3|max:20',
                'fuel_type' => 'required',
                'engine_capacity' => 'required|integer|min:600|max:6000',
                'engine_power' => 'required|integer|min:20|max:2000',
                'drive_type' => 'required',
                'price' => 'required|integer|min:500|max:12000000',
                'car_condition' => 'required',
                'description' => [
                    'required',
                    'string',
                    'min:10',
                    'max:500',
                    'regex:/^[a-zA-Z0-9\s.,!?\\-()ąćęłńóśżźĄĆĘŁŃÓŚŻŹ\n]+$/u'

                ],
                // Dodatkowe wyposazenie
                'car_features' => 'array',
                'car_features.*' => 'array',
                'car_features.*.*' => 'exists:features,slug',

                // Walidacja zdjęć
                'photos' => $request->hasFile('photos') ? 'required|array|min:2|max:5' : 'nullable|array',
                'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',

                // Dane sprzedajacego
                'phone' => 'required|numeric|digits:9',
                'city' => 'required|string|alpha|max:100|min:3',
            ], [
                // Marka
                'carBrand.required' => 'Pole marka jest wymagane.',

                // Model
                'carModel.required' => 'Pole model jest wymagane.',

                // Przebieg
                'mileage.required' => 'Pole przebieg jest wymagane.',
                'mileage.integer' => 'Przebieg musi być liczbą całkowitą.',
                'mileage.min' => 'Przebieg nie może być mniejszy niż 0.',

                // VIN
                'vin.required' => 'Pole VIN jest wymagane.',
                'vin.regex' => 'VIN musi zaczynać się literą (S-Z), zawierać 12 znaków alfanumerycznych i kończyć się 4 cyframi.',
                'vin.unique' => "VIN musi być unikalny. Ten numer istnieje już w bazie danych.",

                // Rok produkcji
                'prod_year.required' => 'Pole rok produkcji jest wymagane.',
                'prod_year.integer' => 'Rok produkcji musi być liczbą całkowitą.',
                'prod_year.min' => 'Rok produkcji nie może być wcześniejszy niż 1900.',
                'prod_year.max' => 'Rok produkcji nie może być z przyszłości.',

                // Typ pojazdu
                'car_type.required' => 'Pole typ pojazdu jest wymagane.',

                // Kolor
                'color.required' => 'Pole kolor jest wymagane.',
                'color.alpha' => 'Pole kolor może zawierać tylko litery.',
                'color.min' => 'Pole kolor musi mieć przynajmniej 3 znaki.',
                'color.max' => 'Pole kolor może mieć maksymalnie 20 znaków.',

                // Typ paliwa
                'fuel_type.required' => 'Pole typ paliwa jest wymagane.',

                // Pojemnosc silnika
                'engine_capacity.required' => 'Pole pojemność silnika jest wymagane.',
                'engine_capacity.integer' => 'Pole pojemność silnika musi być liczbą całkowitą.',
                'engine_capacity.min' => 'Pole pojemność silnika musi wynosić co najmniej 600cm/3.',
                'engine_capacity.max' => 'Pole pojemność silnika może wynosić maksymalnie 6000cm/3.',

                // Moc silnika
                'engine_power.required' => 'Pole moc silnika jest wymagane.',
                'engine_power.integer' => 'Pole moc silnika musi być liczbą całkowitą.',
                'engine_power.min' => 'Pole moc silnika musi wynosić co najmniej 20KM.',
                'engine_power.max' => 'Pole moc silnika może wynosić maksymalnie 2000KM.',

                // Naped
                'drive_type.required' => 'Pole typ napędu jest wymagane.',

                // Cena
                'price.required' => 'Cena jest wymagana.',
                'price.integer' => 'Cena musi być liczbą całkowitą.',
                'price.min' => 'Cena musi być większa niż 500zł.',
                'price.max' => 'Cena musi być mniejsza niż 12000000zł.',

                // Stan
                'car_condition.required' => 'Pole stan samochodu jest wymagane.',

                // Opis
                'description.required' => 'Pole opis jest wymagane.',
                'description.string' => 'Pole opis musi być tekstem.',
                'description.min' => 'Pole opis musi mieć przynajmniej 10 znaków.',
                'description.max' => 'Pole opis może mieć maksymalnie 500 znaków.',
                'description.regex' => 'Pole opis zawiera niedozwolone znaki.',

                // Zdjecia
                'photos.required' => 'Musisz przesłać przynajmniej dwa zdjęcia.',
                'photos.array' => 'Zdjęcia muszą być w formie tablicy.',
                'photos.min' => 'Musisz przesłać przynajmniej dwa zdjęcia.',
                'photos.max' => 'Możesz przesłać maksymalnie pięć zdjęć.',
                'photos.*.image' => 'Każdy przesłany plik musi być obrazem.',
                'photos.*.mimes' => 'Dozwolone formaty zdjęć to: jpeg, jpg, png.',
                'photos.*.max' => 'Każde zdjęcie może mieć maksymalny rozmiar 2048 KB.',

                // Dane sprzedajacego
                'phone.required' => 'Numer telefonu jest wymagany.',
                'phone.numeric' => 'Numer telefonu musi składać się tylko z cyfr.',
                'phone.digits' => 'Numer telefonu musi mieć dokładnie 9 cyfr.',
                'city.required' => 'Miasto jest wymagane.',
                'city.string' => 'Nazwa miasta musi być tekstem.',
                'city.alpha' => 'Nazwa miasta musi składać się tylko z liter.',
                'city.max' => 'Nazwa miasta może mieć maksymalnie 100 znaków.',
            ]);

            $offer->update([
                'price' => $validated['price'],
                'phone' => $validated['phone'],
                'city' => $validated['city'],
                'description' => $validated['description'],
            ]);

            $carModel = CarModel::where('slug', $validated['carModel'])->firstOrFail();
            $carDetails = $offer->carDetails;

            $carDetails->update([
                'vin' => $validated['vin'],
                'mileage' => $validated['mileage'],
                'prod_year' => $validated['prod_year'],
                'car_type' => $validated['car_type'],
                'drive_type' => $validated['drive_type'],
                'fuel_type' => $validated['fuel_type'],
                'car_condition' => $validated['car_condition'],
                'transmission' => $request->transmission,
                'engine_capacity' => $validated['engine_capacity'],
                'engine_power' => $validated['engine_power'],
                'color' => $validated['color'],
                'car_model_id' => $carModel->id,
            ]);

            if (!empty($validated['car_features'])) {
                $carDetails->features()->detach();
                foreach ($validated['car_features'] as $categorySlug => $features) {
                    $featureCategory = FeatureCategory::where('slug', $categorySlug)->firstOrFail();

                    $carFeatures = Feature::whereIn('slug', $features)
                        ->where('category_id', $featureCategory->id)
                        ->get();

                    foreach ($carFeatures as $feature) {
                        $carDetails->features()->attach($feature->id);
                    }
                }
            }

            if ($request->hasFile('photos')) {
                // Usuwanie starych zdjec
                $oldImages = OfferImage::where('offer_id', $offer->id)->get();
                foreach ($oldImages as $oldImage) {
                    $imagePath = public_path('storage/' . $oldImage->path);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                    $oldImage->delete();
                }
                // Zapisywanie nowych zdjec
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store("offer_photos/{$offer->id}/", 'public');

                    OfferImage::create([
                        'offer_id' => $offer->id,
                        'path' => $path,
                    ]);
                }
            }

            DB::commit();

            session()->flash('success', 'Twoja oferta została pomyślnie zaktualizowana!');
            return redirect()->route('dashboard.offers');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();

            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'carBrand' => 'nullable|string|max:255',
            'carModel' => 'nullable|string|max:255',
            'price_min' => 'nullable|numeric|min:0',
            'price_max' => 'nullable|numeric|min:0|gte:price_min',
            'prod_year' => 'nullable|integer|min:1900|max:2024',
            'fuel_type' => 'nullable|string',
        ], [
            'carBrand.string' => 'Marka musi być tekstem.',
            'carBrand.max' => 'Zbyt długa nazwa marki.',
            'price_min.numeric' => 'Cena minimalna musi być liczbą.',
            'price_min.min' => 'Cena minimalna nie może być ujemna.',
            'price_max.numeric' => 'Cena maksymalna musi być liczbą.',
            'price_max.min' => 'Cena maksymalna nie może być ujemna.',
            'price_max.gte' => 'Cena maksymalna musi być większa lub równa cenie minimalnej.',
            'prod_year.integer' => 'Rok produkcji musi być liczbą całkowitą.',
            'prod_year.min' => 'Rok produkcji nie może być starszy niż 1900.',
            'prod_year.max' => 'Rok produkcji nie może być większy niż bieżący rok.',
        ]);

        $query = Offer::query();
        $carBrands = CarBrand::all();
        $fuelTypes = $this->carDataService->getFuelTypes();
        $favoritedOffers = [];
        $validSortOptions = ['price_asc', 'price_desc', 'popular', 'mileage_min', 'mileage_max', 'new'];
        $sortBy = $request->input('sortBy');

        if ($sortBy && !in_array($sortBy, $validSortOptions)) {
            abort(404);
        }

        if (Auth::check()) {
            $userId = Auth::user()->id;
            $query = Offer::where('user_id', '!=', $userId);
            $favoritedOffers = Favorite::where('user_id', $userId)->pluck('offer_id')->toArray();
        }

        if ($request->filled('carBrand')) {
            $query->whereHas('carDetails.carModel.carBrand', function ($query) use ($request) {
                $query->where('car_brands.name', $request->carBrand);
            });
        }

        if ($request->filled('carModel')) {
            $query->whereHas('carDetails.carModel', function ($query) use ($request) {
                $query->where('car_models.slug', $request->carModel);
            });
        }

        if ($request->filled('price_min')) {
            $query->whereRaw('CAST(price AS DECIMAL(10, 2)) >= ?', [$request->price_min]);
        }

        if ($request->filled('price_max')) {
            $query->whereRaw('CAST(price AS DECIMAL(10, 2)) <= ?', [$request->price_max]);
        }
        if ($request->filled('prod_year')) {
            $query->whereHas('carDetails', function ($query) use ($request) {
                $query->whereRaw('CAST(prod_year AS UNSIGNED) = ?', [$request->prod_year]);
            });
        }
      
        if ($request->filled('fuel_type')) {
            $query->whereHas('carDetails', function ($query) use ($request) {
                $query->where('fuel_type', $request->fuel_type);
            });
        }

        if ($request->filled('userId')) {
            $query->where('user_id', $request->userId);
        }

      
        switch($sortBy){
            case 'price_asc':
                $query->orderByRaw('CAST(price AS DECIMAL(10, 2)) ASC');
                break;
            case 'price_desc':
                $query->orderByRaw('CAST(price AS DECIMAL(10, 2)) DESC');
                break;
            case 'popular':
                $query->orderBy('view_count', 'desc');
                break;
            case 'new':
                $query->orderBy('created_at', 'desc');
                break;
            case 'mileage_min':
                $query->join('car_details', 'offers.id', '=', 'car_details.offer_id')
                      ->orderByRaw('CAST(car_details.mileage AS DECIMAL(9, 0)) ASC');
                break;
            case 'mileage_max':
                $query->join('car_details', 'offers.id', '=', 'car_details.offer_id')
                      ->orderByRaw('CAST(car_details.mileage AS DECIMAL(9, 0)) DESC');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        


        try {
            $offers = $query->paginate(10);
            $offers->appends($request->except('page'));



            foreach ($offers as $offer) {
                if ($offer->carDetails) {
                    $offer->carDetails->drive_type_name = $this->carDataService->getNameBySlug(
                        $this->carDataService->getDriveTypes(),
                        $offer->carDetails->drive_type
                    );
                    $offer->carDetails->fuel_type = $this->carDataService->getNameBySlug(
                        $this->carDataService->getFuelTypes(),
                        $offer->carDetails->fuel_type
                    );
                    if ($offer->carDetails->transmission === 'automatic') {
                        $offer->carDetails->transmission = "Automatyczna";
                    } else {
                        $offer->carDetails->transmission = "Manualna";
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Search query failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Wystąpił błąd.']);
        }

        return view('welcome', compact('offers', 'carBrands', 'fuelTypes', 'favoritedOffers'));
    }

    public function destroy($id)
    {
        $offer = Offer::find($id);
        if (Auth::id() !== $offer->user_id) {
            return redirect()->route("dashboard.offers");
        }
        if ($offer) {
            $oldImages = OfferImage::where('offer_id', $offer->id)->get();
            foreach ($oldImages as $oldImage) {
                $imagePath = public_path('storage/' . $oldImage->path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $oldImage->delete();
            }

            $folderPath = public_path('storage/offer_photos/' . $offer->id);

            if (is_dir($folderPath) && count(scandir($folderPath)) == 2) {
                rmdir($folderPath);
            }


            $offer->delete();
            return redirect()->route('dashboard.offers')->with('success', "Pomyślnie usunięto ofertę.");
        } else {
            return redirect()->route('dashboard.offers')->with('error', "Oferta nie została znaleziona.");
        }
    }

    public function show($id)
    {
        $offer = Offer::find($id);
        $isFavorited = "";
        $message = False;

        if (!$offer) {
            abort(404, 'Nie znaleziono takiej oferty!');
        }

        if (Auth::id() !== $offer->user_id) {
            $offer->increment('view_count');
        }
        $userRating = $offer->user->reviewsReceived->avg('rating') ? number_format($offer->user->reviewsReceived->avg('rating'), 2) . '/5' : 'Brak ocen';

        if (Auth::user()) {
            $userId = Auth::user()->id;
            $isFavorited = Favorite::where('user_id', $userId)->first();
        }

        $offer->carDetails->car_condition = $this->carDataService->getNameBySlug(
            $this->carDataService->getVehicleConditions(),
            $offer->carDetails->car_condition
        );
        $offer->carDetails->fuel_type = $this->carDataService->getNameBySlug(
            $this->carDataService->getFuelTypes(),
            $offer->carDetails->fuel_type
        );
        $offer->carDetails->car_type = $this->carDataService->getNameBySlug(
            $this->carDataService->getCarTypes(),
            $offer->carDetails->car_type
        );

        $offer->carDetails->drive_type = $this->carDataService->getNameBySlug(
            $this->carDataService->getDriveTypes(),
            $offer->carDetails->drive_type
        );

        if ($offer->carDetails->transmission == 'automatic') {
            $offer->carDetails->transmission =  "Automatyczna";
        } else {
            $offer->carDetails->transmission = "Manualna";
        }

        $features = $offer->carDetails->features()->with('category')->get()->groupBy('category.category_name');

        return view('offers.show', compact("offer", "features", "isFavorited", "message", 'userRating'));
    }

    public function edit($id)
    {
        $offer = Offer::with('carDetails.features', 'carDetails.features.category', 'images')->findOrFail($id);
        if (Auth::id() !== $offer->user_id) {
            return redirect()->route("dashboard.offers");
        }
        $fuelTypes = $this->carDataService->getFuelTypes();
        $driveTypes = $this->carDataService->getDriveTypes();
        $vehicleConditions = $this->carDataService->getVehicleConditions();
        $carTypes = $this->carDataService->getCarTypes();
        $carBrands = CarBrand::all();


        $featureCategories = FeatureCategory::with('features')->get();

        return view('offers.edit', compact('offer', 'fuelTypes', 'driveTypes', 'vehicleConditions', 'carTypes', 'carBrands', 'featureCategories'));
    }
}
