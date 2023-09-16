@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-body">

                        <img class="card-img-top w-25 h-25 rounded-circle mx-auto p-2"
                            src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile Picture">

                        <h1 class="card-title">User Profile</h1>
                        <p>Email: {{ $profile->email }}</p>
                        <p>Name: {{ $profile->name }}</p>
                        <p>Joined The: {{ $profile->created_at }}</p>
                        <p>Phone Number: {{ $profile->phone_number }}</p>

                        @Auth
                            @if ($profile->id == Auth::user()->id)
                                <a href="{{ route('profile.edit', $profile->id) }}" class="btn btn-primary">Edit Profile</a>
                            @endif
                        @endauth
                    </div>
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

                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <div class="col-md-3 mt-5">
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
                                <h4 class="mr-1">{{ number_format($car->price, 0, ',', ',') }} Dhs</h4>
                            </div>

                            <div class="d-flex flex-column mt-4"><a class="btn btn-primary btn-sm"
                                    href="{{ route('car.details', ['id' => $car->id]) }}">
                                    Details
                                </a>
                                <button class="btn btn-outline-primary btn-sm mt-2 contact-seller-btn" data-toggle="modal"
                                    data-target="#contactSellerModal_{{ $car->id }}">
                                    Contact Seller
                                </button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            @Auth
                                @if ($car->user_id == Auth::user()->id)
                                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mr-3 mb-1">Delete</button>
                                        <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-primary mr-3 mb-1">Edit</a>
                                    </form>
                                @endif
                            @endauth
                        </div>

                    </div>

                    <!-- Modal -->
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
                                    <div class="card-body">
                                        <h2 style="color: red; text-align:center ">Attention !</h2>
                                        <p style="font-size: 15px">You should never send money in advance to the seller by
                                            bank
                                            transfer or through
                                            a
                                            money transfer agency when purchasing goods available on the site.</p>
                                    </div>
                                    <hr>
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
