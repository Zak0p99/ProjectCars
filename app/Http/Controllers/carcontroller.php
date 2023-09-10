<?php

namespace App\Http\Controllers;

use App\Models\car;
use Illuminate\Http\Request;
//use App\Models\Car as CarModel; // Import your Car model 
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brandsWithModels = json_decode(file_get_contents(public_path('brands_with_models.json')), true);
        $cities = json_decode(file_get_contents(public_path('city_names.json')));
        // Define an array of fuel options
        $fuelOptions = [
            'Gasoline',
            'Diesel',
            'Electric',
            'Hybrid',
            'Other',
        ];  
            return view('cars.search', compact('brandsWithModels', 'fuelOptions','cities'));
    }

    public function search(){
    
    $brandsWithModels = json_decode(file_get_contents(public_path('brands_with_models.json')), true);
    $cities = json_decode(file_get_contents(public_path('city_names.json')));
    // Define an array of fuel options
    $fuelOptions = [
        'Gasoline',
        'Diesel',
        'Electric',
        'Hybrid',
        'Other',
    ];  
        return view('cars.search', compact('brandsWithModels', 'fuelOptions','cities'));
    }
    public function searchresult(Request $request)
{
    
    $brand = $request->input('carBrand');
    $model = $request->input('carModel');
    $maxPrice = $request->input('maxPrice');
    $minYear = $request->input('minYear');
    $maxMileage = $request->input('maxMileage');
    $fuel = $request->input('fuel');
    $city = $request->input('city');

    // Perform the database query based on the selected options
    $cars = Car::query()
        ->when($brand, function ($query) use ($brand) {
            $query->where('carbrand', $brand);
        })
        ->when($model, function ($query) use ($model) {
            $query->where('carmodel', $model);
        })
        ->when($maxPrice, function ($query) use ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        })
        ->when($minYear, function ($query) use ($minYear) {
            $query->where('year', '>=', $minYear);
        })
        ->when($maxMileage, function ($query) use ($maxMileage) {
            $query->where('mileage', '<=', $maxMileage);
        })
        ->when(!empty($fuel), function ($query) use ($fuel) {
            if (is_array($fuel)) {
                $query->whereIn('fuel', $fuel);
            } else {
                $query->where('fuel', $fuel);
            }
        })
        ->when($city, function ($query) use ($city) {
            $query->where('city', $city);
        })
        ->get();

    return view('cars.result', compact('cars'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Load the brands JSON data (if needed)
    $brandsWithModels = json_decode(file_get_contents(public_path('brands_with_models.json')), true);
    $cities = json_decode(file_get_contents(public_path('city_names.json')));

    // Define an array of fuel options
    $fuelOptions = [
        'Gasoline',
        'Diesel',
        'Electric',
        'Hybrid',
        'Other',
    ];
    return view('cars.create', compact('brandsWithModels', 'fuelOptions','cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hmcars=Car::where('user_id', Auth::user()->id)->get();
        $user = Auth::user();
        if($user->dealership){
            if(count($hmcars)>=10){
                return redirect()->route('cars.create')->with('error', 'You can only have 10 cars listed at a time with normal account.');
            }
            
        }
        else{
            if(count($hmcars)>=3){
                return redirect()->route('cars.create')->with('error', 'You can only have 3 cars listed at a time with normal account.');
            }
        }
        

        
        // Validate the form data
        $validatedData = $request->validate([
            'carBrand' => 'required',
            'carModel' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image', // Adjust file types and size as needed
            'mileage' => 'required|numeric',
            'fuel' => 'required',
            'year' => 'required|numeric',
            'city' => 'required',
        ]);

        // Upload and store the image
        
        
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
    
            $image->move(public_path('storage'), $imageName);
    
            $imagePath = 'storage/' . $imageName;

        // Create a new Car model instance and fill it with the validated data
        $car = new Car();
        $car->carBrand = $validatedData['carBrand'];
        $car->carModel = $validatedData['carModel'];
        $car->price = $validatedData['price'];
        $car->description = $validatedData['description'];
        $car->image = $imagePath; // Save the image path
        $car->mileage = $validatedData['mileage'];
        $car->fuel = $validatedData['fuel'];
        $car->year = $validatedData['year'];
        $car->city = $validatedData['city'];
        $car->user_id = Auth::id();
        // Save the car record to the database
        $car->save();

        return redirect()->route('user.profile', Auth::user()->id)->with('success', 'Car created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(car $car)
    {
        //
    }
}
