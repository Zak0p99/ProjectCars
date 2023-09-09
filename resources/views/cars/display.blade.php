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
            <p><strong>Image:</strong> <img src="{{ asset($car->image) }}" alt="{{ $car->model }}" width="200"></p>
        </div>
        @endforeach
    </div>
</div>