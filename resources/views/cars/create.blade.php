@extends('layouts.app')

@section('content')


    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include your JavaScript file -->
    <script src="{{ asset('js/car-dropdown.js') }}"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    @if (session('error'))
                        <div class="card-header">
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif


                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="pull-left">
                                    <h2>Create New Car listing</h2>
                                </div>
                                <div class="pull-right">
                                    <a class="btn btn-primary" href="{{ route('cars.index') }}"> Back</a>
                                </div>
                            </div>
                        </div>

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
                        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
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


                            <label for="price">Price:</label>
                            <input class="form-control" type="number" name="price" id="price" required>

                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description" id="description" required></textarea>


                            <label for="mileage">Mileage:</label>
                            <input type="number" name="mileage" id="mileage" required>

                            <label for="image">Image:</label>
                            <input type="file" name="image" id="image" required>

                            <label for="year">Select Car Year:</label>
                            <select class="form-select" id="year" name="year" class="form-control">
                                <option value="">Select a year</option>
                                @for ($year = 1900; $year <= 2023; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>

                            <div class="form-group">
                                <label for="fuel">Select Fuel Type:</label>
                                <select class="form-select" id="fuel" name="fuel" class="form-control">
                                    <option value="">Select fuel type</option>
                                    @foreach ($fuelOptions as $fuel)
                                        <option value="{{ $fuel }}">{{ $fuel }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="city">Select a City:</label>
                            <select class="form-select" id="city" name="city" class="form-control">
                                <option value="">Select a city</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city }}">{{ $city }}</option>
                                @endforeach
                            </select>


                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
