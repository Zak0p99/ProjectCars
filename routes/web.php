<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\carController; // Import the carController class.
use App\Http\Controllers\DisplayController; // Import the DisplayController class.
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('cars', carController::class); // Define the resource route for cars.

Route::post('/cars', [CarController::class, 'store'])->name('cars.store'); // Define the route for storing a car.

Route::get('/display', [DisplayController::class, 'index'])->name('cars.display');