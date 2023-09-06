<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('carbrand'); // Define 'brand' column as a string.
            $table->string('carmodel'); // Define 'model' column as a string.
            $table->string('year'); // Define 'year' column as a string.
            $table->decimal('price', 10, 2); // Define 'price' column as a decimal with 10 total digits and 2 decimal places.
            $table->text('description'); // Define 'description' column as text.
            $table->string('image'); // Define 'image' column as a string and allow NULL values.
            $table->integer('mileage'); // Define 'mileage' column as an integer.
            $table->string('fuel'); // Define 'fuel' column as a string.
            $table->string('city'); // Define 'city' column as a string.
            
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
