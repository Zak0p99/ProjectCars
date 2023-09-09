<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController; // Import the CarController class.
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



Route::get('/cars/search',[CarController::class,'search'])->name('cars.search');

Route::get('cars/create', 'CarController@create')->middleware('auth');

Route::get('/cars/searchresult',[CarController::class,'searchresult'])->name('cars.searchresult');

Route::post('/cars', [CarController::class, 'store'])->name('cars.store'); // Define the route for storing a car.

Route::get('/display', [DisplayController::class, 'index'])->name('cars.display');

Route::resource('cars', CarController::class); // Define the resource route for cars.








Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
