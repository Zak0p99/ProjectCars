@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">


                    <div class="card-body">
                        <h1 style="align-content: center">Search Results</h1>
                        @if ($cars->isEmpty())
                            <p>No cars found matching your criteria.</p>
                        @else
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10">
                @foreach ($cars as $car)
                    <div class="row p-2 bg-white border rounded mb-2">
                        <div class="col-md-3 mt-1">
                            @if ($car->images->count() > 0)
                                <!-- Display the first image as a thumbnail with a maximum height -->
                                <img class="img-fluid img-responsive rounded product-image"
                                    src="{{ asset($car->images[0]->image_path) }}" style="max-height: 200px; width: 200px;">
                            @else
                                <!-- Display a default image or message if no images are available -->
                                <img class="img-fluid img-responsive rounded product-image"
                                    src="{{ asset('path_to_default_image.jpg') }}" alt="No Image">
                            @endif
                        </div>
                        <div class="col-md-6 mt-1">
                            <h2 style="color: black ; display:inline">{{ $car->carbrand }}</h2>
                            <b> - Modele :</b>
                            <h3 style="color: rgb(0, 0, 0) ; display:inline ">{{ $car->carmodel }}
                            </h3>
                            <div class="info">
                                <span><b>Year : </b>{{ $car->year }}</span>

                                <span><b>kilométrage : </b>{{ number_format($car->mileage, 0, ',', ',') }}km</span>
                            </div>
                            <div class="info"> <span><b>Fuel : </b>{{ $car->fuel }}</span>
                                <span><b>City : </b>{{ $car->city }}</span>
                            </div>
                            <br />
                            <h5 class="mt-1 mb-1">Description :</h5>
                            <p class="text-justify text-truncate para mb-0"><span>{{ $car->description }}
                                </span><br><br></p>
                        </div>
                        <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                            <div class="d-flex flex-row align-items-center">
                                <h4 class="mr-1">{{ number_format($car->price, 0, ',', ',') }} Dhs</h4>
                            </div>

                            <div class="d-flex flex-column mt-4"> <a class="btn btn-primary btn-sm"
                                    href="{{ route('car.details', ['id' => $car->id]) }}">
                                    Details
                                </a>
                                <a class="btn btn-outline-primary btn-sm mt-2" href="#" data-toggle="modal"
                                    data-target="#contactSellerModal_{{ $car->id }}">
                                    Contact Seller
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="contactSellerModal_{{ $car->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="contactSellerModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="text-align: center;">
                                    <div style="text-align: center;">
                                        <h5 class="modal-title text-center" id="contactSellerModalLabel"
                                            style="display: inline-block; width: 100%;">
                                            Contact Seller
                                        </h5>

                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Add your contact form or content here -->
                                    <b>Name: </b>{{ $car->user->name }}<br>
                                    <b>Email: </b>{{ $car->user->email }}<br>

                                    <b>Phone Number: </b>{{ $car->user->phone_number }}
                                    <br>
                                    <a href="{{ route('user.profile', $car->user->id) }}">View Profile</a>
                                    <!-- You can use Laravel Blade directives to include a form or any other content -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <!-- Add additional buttons if needed -->
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
