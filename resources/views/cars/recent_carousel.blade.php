<!-- resources/views/recent_carousel.blade.php -->

<div id="recent-carousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        @foreach ($recentCars as $key => $car)
            <li data-target="#recent-carousel" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}">
            </li>
        @endforeach
    </ol>

    <!-- Slides -->
    <div class="carousel-inner">
        @foreach ($recentCars as $key => $car)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{ asset($car->images[0]->image_path) }}" alt="{{ $car->carbrand }} - {{ $car->carmodel }}">
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
