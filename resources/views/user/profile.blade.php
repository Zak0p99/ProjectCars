@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">


                    <div class="card-body">

                        <body>
                            <h1>User Profile</h1>
                            <p>Email: {{ $profile->email }}</p>
                            <p>Name: {{ $profile->name }}</p>
                            <p>Joined The: {{ $profile->created_at }}</p>
                            <p>Phone Number: {{ $profile->phone_number }}</p>

                        </body>

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
                            <h3 style="color: rgb(172, 179, 179) ; display:inline ">{{ $car->carmodel }}
                            </h3>
                            <div>
                                <span><b>Year : </b>{{ $car->year }}</span>
                                <br />
                                <span><b>kilométrage : </b>{{ $car->mileage }}km</span>
                            </div>
                            <div> <span><b>Fuel : </b>{{ $car->fuel }}</span>
                                <br><span><b>City : </b>{{ $car->city }}</span>
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
                                <button class="btn btn-outline-primary btn-sm mt-2" type="button">Contact Seller</button>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
