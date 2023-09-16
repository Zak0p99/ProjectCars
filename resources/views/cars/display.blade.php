@extends('layouts.app')

@section('content')

    <div>
        <h1>Car Details</h1>
        <div>
            @foreach ($cars as $car)
                <div>
                    <p><strong>Brand:</strong> {{ $car->brand }}</p>
                    <p><strong>Model:</strong> {{ $car->model }}</p>
                    <p><strong>Year:</strong> {{ $car->year }}</p>
                    <p><strong>Price:</strong> {{ $car->price }}</p>
                    <div class="image-gallery">
                        @foreach ($car->images as $image)
                            <img src="{{ asset($image->image_path) }}" alt="{{ $car->carModel }}">
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
