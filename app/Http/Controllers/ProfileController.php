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
    public function edit($id)
{
    $profile = User::find($id);

    return view('user.edit_profile', compact('profile'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id); // Use the User model here, not Profile.

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'phone_number' => 'required|string|max:20',
        // Add validation rules for other fields as needed
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        // Update other fields here
    ]);

    return redirect()->route('user.profile', ['user' => $user->id])->with('success', 'Profile updated successfully');
}


}
