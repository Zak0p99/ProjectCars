@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">
                        <h1>Search for Car</h1>
                        <!-- Include jQuery -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <!-- Include your JavaScript file -->
                        <script src="{{ asset('js/car-dropdown.js') }}"></script>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('cars.searchresult') }}" method="GET" enctype="multipart/form-data">

                            @csrf

                            <!-- First Dropdown for Car Brand -->
                            <label for="carBrand">Select Car Brand:</label>
                            <select class="form-select" id="carBrand" name="carBrand">
                                <option value="">Select a brand</option>
                                @foreach ($brandsWithModels as $brand => $models)
                                    <option value="{{ $brand }}">{{ $brand }}</option>
                                @endforeach
                            </select>

                            <!-- Second Dropdown for Car Models -->
                            <label for="carModel">Select Car Model:</label>
                            <select class="form-select" id="carModel" name="carModel">
                                <option value="">Select a model</option>
                            </select>

                            <script>
                                // JavaScript to populate the second dropdown based on the selected brand
                                const carBrandSelect = document.getElementById('carBrand');
                                const carModelSelect = document.getElementById('carModel');

                                carBrandSelect.addEventListener('change', function() {
                                    const selectedBrand = carBrandSelect.value;
                                    const models = @json($brandsWithModels);

                                    // Clear the previous options
                                    carModelSelect.innerHTML = '<option value="">Select a model</option>';

                                    if (selectedBrand !== '') {
                                        models[selectedBrand].forEach(function(model) {
                                            const option = document.createElement('option');
                                            option.value = model;
                                            option.text = model;
                                            carModelSelect.appendChild(option);
                                        });
                                    }
                                });
                            </script>

                            <!-- Dropdown for Maximum Price -->
                            <div class="form-group">
                                <label for="maxPrice">Select Maximum Price:</label>
                                <select id="maxPrice" name="maxPrice" class="form-control">
                                    <option value="">Any</option>
                                    @for ($price = 10000; $price <= 5000000; $price += 10000)
                                        <option value="{{ $price }}">{{ number_format($price) }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Dropdown for Minimum Year -->
                            <div class="form-group">
                                <label for="minYear">Select Minimum Year:</label>
                                <select id="minYear" name="minYear" class="form-control">
                                    <option value="">Any</option>
                                    @for ($year = 1900; $year <= 2023; $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Dropdown for Fuel -->
                            <div class="form-group">
                                <label for="fuel">Select Fuel Type:</label>
                                <select id="fuel" name="fuel" class="form-control">
                                    <option value="">Select fuel type</option>
                                    @foreach ($fuelOptions as $fuel)
                                        <option value="{{ $fuel }}">{{ $fuel }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Dropdown for Maximum Mileage -->
                            <div class="form-group">
                                <label for="maxMileage">Select Maximum Mileage:</label>
                                <select id="maxMileage" name="maxMileage" class="form-control">
                                    <option value="">Any</option>
                                    @for ($mileage = 10000; $mileage <= 110000; $mileage += 10000)
                                        <option value="{{ $mileage }}">{{ number_format($mileage) }}</option>
                                    @endfor
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
