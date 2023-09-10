@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Profile</div>

                    <div class="card-body">

                        <body>
                            <h1>User Profile</h1>
                            <p>Email: {{ $profile->email }}</p>
                            <p>Phone Number: {{ $profile->phone_number }}</p>

                        </body>

                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Displayed Cars</div>

                    <div class="card-body">

                        <body>
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
                                            <td>{{ $car->user->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </body>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
