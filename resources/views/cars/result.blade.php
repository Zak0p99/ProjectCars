@extends('cars.layout')

@section('content')
    <h1>Search Results</h1>

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
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Fuel</th>
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
                        <td><img src="{{ asset('storage/images/' . $car->image) }}" alt="Car Image" width="100"></td>
                        <td>{{ $car->created_at }}</td>
                        <td>{{ $car->fuel}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
