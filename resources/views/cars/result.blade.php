@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Car Search Results') }}</div>

                    <div class="card-body">

                        @if ($cars->isEmpty())
                            <p>No cars found matching your criteria.</p>
                        @else
                            <table>
                                <thead>
                                    <tr>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Price</th>
                                        <th>Year</th>
                                        <th>Mileage</th>
                                        <th>Description</th>
                                        <th>City</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Fuel</th>
                                        <th>User</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cars as $car)
                                        <tr>
                                            <td>{{ $car->carbrand }}</td>
                                            <td>{{ $car->carmodel }}</td>
                                            <td>{{ $car->price }}</td>
                                            <td>{{ $car->year }}</td>
                                            <td>{{ $car->mileage }}</td>
                                            <td>{{ $car->description }}</td>
                                            <td>{{ $car->city }}</td>
                                            <td><img src="{{ asset($car->image) }}" alt="Car Image" width="100"></td>
                                            <td>{{ $car->created_at }}</td>
                                            <td>{{ $car->fuel }}</td>
                                            <td><a
                                                    href="{{ route('user.profile', $car->user->id) }}">{{ $car->user->name }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

                                    <b>Phone Number: </b>{{ $car->user->phonenumber }}
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
