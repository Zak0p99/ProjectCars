@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Listing of {{ $car->carbrand }} modele:{{ $car->carmodel }} by
                        {{ $car->user->name }}</div>
                    <div class="card-body">
                        <!-- Display car details here -->
                        <div class="text-center">
                            <img src="{{ asset($car->image) }}" alt="Car Image" width="700">
                        </div>
                        <div class="mt-3">
                            <p><strong>Brand:</strong> {{ $car->carbrand }}</p>
                            <p><strong>Model:</strong> {{ $car->carmodel }}</p>
                            <p><strong>Price:</strong> {{ $car->price }} Dhs</p>
                            <p><strong>Year:</strong> {{ $car->year }}</p>
                            <p><strong>Mileage:</strong> {{ $car->mileage }} km</p>
                            <p><strong>Description:</strong> {{ $car->description }}</p>
                            <p><strong>City:</strong> {{ $car->city }}</p>
                            <p><strong>Fuel:</strong> {{ $car->fuel }}</p>
                            <p><strong>Created At:</strong> {{ $car->created_at }}</p>
                            <p><strong>User:</strong> <a
                                    href="{{ route('user.profile', $car->user->id) }}">{{ $car->user->name }}</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
