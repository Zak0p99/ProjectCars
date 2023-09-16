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

                        <!-- Display car details here -->

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

                        <div class="mt-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Brand:</strong> {{ $car->carbrand }}
                                </div>
                                <div class="col-md-3">
                                    <strong>Model:</strong> {{ $car->carmodel }}
                                </div>
                                <div class="col-md-3">
                                    <strong>Price:</strong> {{ number_format($car->price, 0, ',', ',') }} Dhs
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
                                    <strong>Seller:</strong> <a
                                        href="{{ route('user.profile', $car->user->id) }}">{{ $car->user->name }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <strong>Description:</strong> {{ $car->description }}
                                </div>
                            </div>

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
