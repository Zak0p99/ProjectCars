@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <button class="btn btn-primary mb-3" onclick="goBack()">Back</button>

                <div class="card">
                    <div class="card-header text-center font-weight-bold h2">
                        Listing of {{ $car->carbrand }} - Model: {{ $car->carmodel }} by {{ $car->user->name }}
                    </div>
                    <div class="card-body">
                        <!-- Displaying car details here -->

                        <!-- Car Carousel -->
                        <div id="carCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($car->images as $key => $image)
                                    <li data-target="#carCarousel" data-slide-to="{{ $key }}"
                                        class="{{ $key === 0 ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($car->images as $key => $image)
                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                        <img style="object-fit: contain" class="d-block w-100 car-image"
                                            src="{{ asset($image->image_path) }}" alt="{{ $car->carModel }}">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                        <!-- Car Details -->
                        <div class="container mt-3">
                            <div class="row">
                                <!-- Left Side Card Body -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Car Information</h5>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><strong>Brand:</strong> {{ $car->carbrand }}
                                                </li>
                                                <li class="list-group-item"><strong>Model:</strong> {{ $car->carmodel }}
                                                </li>
                                                <li class="list-group-item"><strong>Price:</strong>
                                                    {{ number_format($car->price, 0, ',', ',') }} Dhs</li>
                                                <li class="list-group-item"><strong>Kilometers:</strong>
                                                    {{ number_format($car->mileage, 0, ',', ',') }} km</li>
                                                <li class="list-group-item"><strong>City:</strong> {{ $car->city }}</li>
                                                <li class="list-group-item"><strong>Fuel:</strong> {{ $car->fuel }}</li>
                                                <li class="list-group-item"><strong>Year:</strong> {{ $car->year }}</li>
                                                <li class="list-group-item"><strong>Created At:</strong>
                                                    {{ $car->created_at }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Side Card Body for Description -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Description :</h5>
                                            <p class="card-text">{{ $car->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seller Information Card (Right Side) -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="card-title">Seller Information</h3>
                        <img class="img-fluid rounded-circle mb-2" width="100px" height="100px"
                            src="{{ asset('storage/' . $car->user->profile_picture) }}" alt="seller profile picture">

                        <!-- Display seller information here -->
                        <ul class="list-unstyled">
                            <li><b>Name:</b> {{ $car->user->name }}</li>
                            <li><b>Email:</b> {{ $car->user->email }}</li>
                            <li><b>Phone Number:</b> {{ $car->user->phone_number }}</li>
                        </ul>
                        <a class="btn btn-primary mt-3" href="{{ route('user.profile', $car->user->id) }}">View Seller
                            Profile</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <style>
        /* Custom CSS to control image dimensions in the carousel */
        .car-image {
            max-height: 300px;
            min-height: 300px;
            /* Set the maximum height of the images */
            width: auto;
            /* Allow the width to adjust automatically */
        }
    </style>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
