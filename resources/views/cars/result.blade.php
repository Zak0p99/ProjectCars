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
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->price }}</td>
                        <td>{{ $car->year }}</td>
                        <td>{{ $car->mileage }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
