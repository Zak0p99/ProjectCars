<?php

namespace App\Http\Controllers;

use App\Models\car;
use Illuminate\Http\Request;
//use App\Models\Car as CarModel; // Import your Car model 
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\CarImage;
class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    
    $recentCars = Car::orderBy('created_at', 'desc')->take(3)->get();
    
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
    return view('cars.search', compact('brandsWithModels', 'fuelOptions', 'cities', 'recentCars'));
}



    public function search(){
    $recentCars = Car::orderBy('created_at', 'desc')->take(3)->get();
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
        return view('cars.search', compact('brandsWithModels', 'fuelOptions','cities', 'recentCars'));
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
                return redirect()->route('cars.create')->with('error', 'You can only have 10 cars listed at a time with a dealership account rank 3 account.');
            }
            
        }
        else{
            if(count($hmcars)>=3){
                return redirect()->route('cars.create')->with('error', 'You can only have 3 cars listed at a time with a normal account.');
            }
        }
        

        
        // Validate the form data
        $validatedData = $request->validate([
            'carBrand' => 'required',
            'carModel' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'images.*' => 'required|image', // Use 'images.*' to validate multiple images
            'mileage' => 'required|numeric',
            'fuel' => 'required',
            'year' => 'required|numeric',
            'city' => 'required',
        ]);

        

        // Create a new Car model instance and fill it with the validated data
        $car = new Car();
        $car->carBrand = $validatedData['carBrand'];
        $car->carModel = $validatedData['carModel'];
        $car->price = $validatedData['price'];
        $car->description = $validatedData['description'];
       
        $car->mileage = $validatedData['mileage'];
        $car->fuel = $validatedData['fuel'];
        $car->year = $validatedData['year'];    
        $car->city = $validatedData['city'];
        $car->user_id = Auth::id();
        // Save the car record to the database
        $car->save();

        foreach ($request->file('images') as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/car_images', $imageName);
        
            // Create a new car image record
            $carImage = new CarImage();
            $carImage->image_path = 'storage/car_images/' . $imageName;
        
            // Associate the image with the car
            $carImage->car_id = $car->id; // Assuming you have a 'car_id' column in the 'car_images' table
            $carImage->save();
        }

        return redirect()->route('user.profile', Auth::user()->id)->with('success', 'Car created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(car $car)
    {
        //
    }
    public function showDetails($id)
{
    $car = Car::find($id);
    if (!$car) {
        // Handle the case where the car with the given ID is not found
        abort(404);
    }

    return view('cars.car_details', ['car' => $car]);
}   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
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
        $car = Car::findOrFail($id); // Fetch the car data

        // Load any additional data you want to pass to the view here

        return view('cars.edit_car', compact('car','brandsWithModels', 'fuelOptions','cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'carBrand' => 'required',
        'carModel' => 'required',
        'price' => 'required|numeric',
        'description' => 'required',
        'images.*' => 'image', // Allow updating images, but not required
        'mileage' => 'required|numeric',
        'fuel' => 'required',
        'year' => 'required|numeric',
        'city' => 'required',
    ]);

    // Find the car by its ID
    $car = Car::findOrFail($id);

    // Update the car details based on the form data
    $car->carBrand = $validatedData['carBrand'];
    $car->carModel = $validatedData['carModel'];
    $car->price = $validatedData['price'];
    $car->description = $validatedData['description'];
    $car->mileage = $validatedData['mileage'];
    $car->fuel = $validatedData['fuel'];
    $car->year = $validatedData['year'];
    $car->city = $validatedData['city'];

    // Check if new images were uploaded
    if ($request->hasFile('images')) {
        // Delete the existing car images
        foreach ($car->images as $image) {
            // Delete the image file from storage (if needed)
            if (Storage::exists($image->image_path)) {
                Storage::delete($image->image_path);
            }

            // Delete the image record from the database
            $image->delete();
        }

        // Upload and store the new images
        foreach ($request->file('images') as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/car_images', $imageName);

            // Create a new car image record
            $carImage = new CarImage();
            $carImage->image_path = 'storage/car_images/' . $imageName;

            // Associate the image with the car
            $car->images()->save($carImage);
        }
    }

    // Save the changes
    $car->save();

    // Redirect back to the car details page or a listing page
    return redirect()->route('user.profile', Auth::user()->id)->with('success', 'Car listing updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $car = Car::findOrFail($id);

    // Check if the currently authenticated user owns the car listing
    if (Auth::user()->id == $car->user_id) {
        // Delete the associated car images
        foreach ($car->images as $image) {
            // Delete the image file from storage (if needed)
            if (Storage::exists($image->image_path)) {
                Storage::delete($image->image_path);
            }

            // Delete the image record from the database
            $image->delete();
        }

        // Delete the car listing
        $car->delete();

        // Add a success message
        Session::flash('success', 'Car listing and associated images deleted successfully.');

        return redirect()->back(); // Redirect back to the user's profile page or a listing page.
    } else {
        // If the user doesn't own the listing, add an error message
        Session::flash('error', 'You do not have permission to delete this car listing.');
        return redirect()->back();
    }
}

}
