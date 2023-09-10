<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model.
use App\Models\Car; // Import the Car model.
class ProfileController extends Controller
{
    public function show(int $user)
    {
        $cars = Car::where('user_id', $user)->get();
        $profile= User::find($user);
        return view('user.profile', compact('profile','cars'));
    }
}
