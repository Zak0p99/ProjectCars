<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['carbrand', 'carModel', 'price', 'description', 'mileage', 'fuel', 'year', 'city', 'image'];

    // Define the user relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
