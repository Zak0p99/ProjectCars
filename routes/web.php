<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController; // Import the CarController class.
use App\Http\Controllers\DisplayController; // Import the DisplayController class.
use App\Http\Controllers\ProfileController;
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

Route::put('/profile/{id}', [ProfileController::class,'update'])->name('profile.update');


Route::get('/cars/search',[CarController::class,'search'])->name('cars.search');


Route::get('/car/details/{id}', [CarController::class, 'showDetails'])->name('car.details');

Route::delete('/cars/{id}', [CarController::class,'destroy'])->name('cars.destroy');




Route::get('/cars/searchresult',[CarController::class,'searchresult'])->name('cars.searchresult');

Route::post('/cars', [CarController::class, 'store'])->name('cars.store'); // Define the route for storing a car.

Route::get('/display', [DisplayController::class, 'index'])->name('cars.display');


Route::get('cars/create', 'CarController@create')->middleware('auth');

Route::resource('cars', CarController::class); // Define the resource route for cars.

Route::resource('profile', ProfileController::class); // Define the resource route for profiles.

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/{user}', 'ProfileController@show')->name('user.profile');
}); // Define the route for displaying a user's profile.
















Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

