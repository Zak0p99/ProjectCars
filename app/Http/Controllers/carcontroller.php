<?php

namespace App\Http\Controllers;

use App\Models\car;
use Illuminate\Http\Request;
use App\Models\Car as CarModel; // Import your Car model

class carcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Load the brands JSON data (if needed)
    $brandsWithModels = json_decode(file_get_contents(public_path('brands_with_models.json')), true);


    // Define an array of fuel options
    $fuelOptions = [
        'Gasoline',
        'Diesel',
        'Electric',
        'Hybrid',
        'Other',
    ];
    return view('cars.create', compact('brandsWithModels', 'fuelOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // $uploadedFile = $request->file('image');
        
        // Validate the form data
        $validatedData = $request->validate([
            'carBrand' => 'required',
            'carModel' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image', // Adjust file types and size as needed
            'mileage' => 'required|numeric',
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

        // Save the car record to the database
        $car->save();

        return redirect()->route('cars.display')->with('success', 'Car created successfully');

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
