@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card flex-row  align-items-center">

                    <img class="card-img-left w-25 h-25 rounded-circle p-2"
                        src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile Picture">
                    <div class="card-body">


                        <h1>User Profile</h1>
                        <p>Email: {{ $profile->email }}</p>
                        <p>Name: {{ $profile->name }}</p>
                        <p>Joined The: {{ $profile->created_at }}</p>
                        <p>Phone Number: {{ $profile->phone_number }}</p>


                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10">
                @foreach ($cars as $car)
                    <div class="row p-2 bg-white border rounded">
                        <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image"
                                src="{{ asset($car->image) }}"></div>
                        <div class="col-md-6 mt-1">
                            <h2 style="color: black ; display:inline">{{ $car->carbrand }}</h2>
                            <b> - Modele :</b>
                            <h3 style="color: rgb(0, 0, 0) ; display:inline ">{{ $car->carmodel }}
                            </h3>
                            <div class="info">
                                <span><b>Year : </b>{{ $car->year }}</span>

                                <span><b>kilométrage : </b>{{ $car->mileage }}km</span>
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
                                <h4 class="mr-1">{{ $car->price }} Dhs</h4>
                            </div>

                            <div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button"
                                    style="height: 3.5rem ; font-size:20px ; font-weight:bold">Details</button>
                                <button class="btn btn-outline-primary btn-sm mt-2 contact-seller-btn" data-toggle="modal"
                                    data-target="#contactSellerModal_{{ $car->id }}">
                                    Contact Seller
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="contactSellerModal_{{ $car->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="contactSellerModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="contactSellerModalLabel">Contact Seller</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><b>Name: </b>{{ $car->user->name }}</p>
                                    <p><b>Email: </b>{{ $car->user->email }}</p>
                                    <p><b>Phone Number: </b>{{ $car->user->phone_number }}</p>
                                    <p><a href="{{ route('user.profile', $car->user->id) }}">View Profile</a></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <!-- You can add more buttons or actions here if needed -->
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
