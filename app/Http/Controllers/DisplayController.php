<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class DisplayController extends Controller
{
    
    public function index()
    {
        // Retrieve the cars data from the database
        $cars = Car::all(); // You can modify this query as needed

        // Pass the data to a view and render it
        return view('cars.display', compact('cars'));
    }
}
