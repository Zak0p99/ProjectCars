<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class car extends Model
{
    protected $fillable = ['carbrand', 'carModel', 'price', 'description', 'mileage', 'fuel', 'year', 'city', 'image'];
    use HasFactory;
}
