@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center font-weight-bold h2">
                        Listing of {{ $car->carbrand }} - Modele : {{ $car->carmodel }} by {{ $car->user->name }}
                    </div>


                    <div class="card-body">
                        <!-- Display car details here -->
                        <div class="text-center">
                            <img src="{{ asset($car->image) }}" alt="Car Image" width="700">
                        </div>
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Brand:</strong> {{ $car->carbrand }}
                                </div>
                                <div class="col-md-3">
                                    <strong>Model:</strong> {{ $car->carmodel }}
                                </div>
                                <div class="col-md-3">
                                    <strong>Price:</strong> {{ $car->price }} Dhs
                                </div>
                                <div class="col-md-3">
                                    <strong>Year:</strong> {{ $car->year }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Mileage:</strong> {{ $car->mileage }} km
                                </div>
                                <div class="col-md-3">
                                    <strong>Description:</strong> {{ $car->description }}
                                </div>
                                <div class="col-md-3">
                                    <strong>City:</strong> {{ $car->city }}
                                </div>
                                <div class="col-md-3">
                                    <strong>Fuel:</strong> {{ $car->fuel }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Created At:</strong> {{ $car->created_at }}
                                </div>
                                <div class="col-md-3">
                                    <strong>User:</strong> <a
                                        href="{{ route('user.profile', $car->user->id) }}">{{ $car->user->name }}</a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
