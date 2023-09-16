@extends('layouts.app')

@section('content')



    <head>
        <style>
            .custom-card {
                margin: 10px;
                /* Adjust the margin as needed */
            }
        </style>
    </head>
    <div class="container mt-5">
        <div class="row justify-content-center ">
            <div class="card " style="padding: 0px">

                <div class="card-body"
                    style="background-image: url({{ asset('background.jpeg') }}); background-size:cover; background-repeat:no-repeat;background-position:center center">

                    <div class="row">
                        <!-- Left Column - Search Form Card -->
                        <div class="col-md-6">
                            <div class="card" style="border: 1px solid #ccc;">
                                <div class="card-body shadow">
                                    <h1>Search for Car</h1>
                                    <!-- Include jQuery -->
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <!-- Include your JavaScript file -->
                                    <script src="{{ asset('js/car-dropdown.js') }}"></script>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <strong>Whoops!</strong> There were some problems with your
                                            input.<br><br>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('cars.searchresult') }}" method="GET"
                                        enctype="multipart/form-data">
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
                                                    <option value="{{ $price }}">{{ number_format($price) }}
                                                    </option>
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
                                                    <option value="{{ $fuel }}">{{ $fuel }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Dropdown for Maximum Mileage -->
                                        <div class="form-group">
                                            <label for="maxMileage">Select Maximum Mileage:</label>
                                            <select id="maxMileage" name="maxMileage" class="form-control">
                                                <option value="">Any</option>
                                                @for ($mileage = 10000; $mileage <= 110000; $mileage += 10000)
                                                    <option value="{{ $mileage }}">
                                                        {{ number_format($mileage) }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="text-center" style="margin-top: 10px">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Text -->
                        <div class="col-md-6 d-flex">
                            <p class="mt-auto mb-auto" style="font-size: 30px; color: aliceblue">
                                Explore our wide selection of quality cars. Refine your search criteria on the left
                                to
                                find the perfect vehicle that meets your needs and budget.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
            <h1 class="mt-5 mb-3" style=";text-align: center">Recent Cars</h1>
            <div id="recent-carousel" class="carousel slide shadow" data-ride="carousel"
                style="width: 1280px; height: 720px;">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @foreach ($recentCars as $key => $car)
                        <li data-target="#recent-carousel" data-slide-to="{{ $key }}"
                            class="{{ $key == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>

                <!-- Slides -->
                <div class="carousel-inner" style="width: 100%; height: 100%;">
                    @foreach ($recentCars as $key => $car)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" style="width: 100%; height: 100%;">
                            <img src="{{ asset($car->images[0]->image_path) }}"
                                alt="{{ $car->carbrand }} - {{ $car->carmodel }}"
                                style="object-fit: cover; width: 100%; height: 100%;">
                            <div class="carousel-caption">
                                <h3>{{ $car->carbrand }} - {{ $car->carmodel }}</h3>
                                <p>Year: {{ $car->year }}, Mileage: {{ $car->mileage }}km</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Controls -->
                <a class="carousel-control-prev" href="#recent-carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#recent-carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>



            <div class="card mt-5">
                <div class="card-body">
                    <p>
                        Ne cherchez plus votre prochaine voiture. Visitez carmarketplace.com.

                        Bienvenue sur carmarketplace.com. Vous y trouverez chaque jour plus de 900 000 million de véhicules
                        en
                        provenance

                        du Maroc. Voitures neuves et d’occasion, petites cylindrées, voitures de
                        collection, limousines de luxe ou bonnes affaires : quel que soit le type de véhicule recherché,
                        vous le
                        trouverez sur carmarketplace.com.
                        carmarketplace.com est le plus grand portail automobile allemand qui facilite l’achat
                        d’un véhicule. Par une simple recherche et en quelques clics, vous pourrez obtenir un aperçu de
                        l’ensemble du marché automobile. Vous pourrez facilement comparer et prendre une décision, mais
                        aussi
                        contacter des vendeurs de voitures neuves et d’occasion, gratuitement, aisément et sans soucis.
                        Vous souhaitez acheter une voiture d’occasion Sur carmarketplace.com, vous trouverez des offres de
                        professionnels et de particuliers adaptées à vos besoins.
                        Elles peuvent même être assorties d’une garantie véhicule d’occasion, si nécessaire.
                        Ou peut-être recherchez-vous une voiture neuve ? Alors, vous êtes au bon endroit. Des véhicules
                        flambant
                        neufs, des voitures CE neuves, des voitures avec immatriculations pour une journée et des voitures
                        de société parfaitement entretenues . Le tout clairement détaillé et offrant un vaste choix.
                        En d’autres termes, sur carmarketplace.com, vous trouverez facilement le véhicule adapté à votre
                        mode de
                        vie. carmarketplace.com - Quel sera votre prochain véhicule?
                    </p>
                </div>
            </div>
        </div>
        <footer class="footer mt-5">
            <div class="container text-center">
                <p>© 2023 CarMarketPlace, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
            </div>
        </footer>

    @endsection
