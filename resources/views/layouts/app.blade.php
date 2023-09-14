<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Car Marketplace</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        .custom-card-body {
            max-width: 800px;
            /* Adjust the width as needed */
            margin: 0 auto;
            /* Center the content horizontally */
            padding: 20px;
            /* Add padding for spacing */
        }

        .custom-btn {
            background-color: red;
            color: white;
        }

        .info span {
            margin-right: 20px;
            /* Adjust the value to control the amount of space between spans */
        }

        .custom-dropdown-menu {
            border: 1px solid #ccc;
            /* Border style */
            border-radius: 0.25rem;
            /* Rounded corners */
        }

        .custom-dropdown-button {
            border: 1px solid #ccc;
            /* Border style */
            border-radius: 0.5rem;
            /* Rounded corners */
            padding: 5px 15px;
            /* Adjust padding as needed */
        }

        .custom-dropdown-button:hover {
            background-color: #f3f3f3;
            /* Darker white color (adjust as needed) */
            border-color: red;
            /* Red border color when hovered */
        }
    </style>
</head>

<body class="vw-100" style="background-image: url({{ asset('5517618.jpg') }})">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-5">
            <div class="container">
                <div class="d-flex  justify-content-center align-items-center">
                    <a class="navbar-brand"
                        style="font-weight: bold ; font-size:25px ; left:-100px ; position:relative ;"
                        href="{{ url('/cars/search') }}"><img src="{{ asset('/logo.png') }}" alt="logo"
                            height="35">
                        Car Marketplace
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <ul class="navbar-nav ml-auto flex-row align-items-center">
                                <!-- First list item -->
                                <li class="nav-item me-3">
                                    <!-- Add margin-left (ms-3) class to create horizontal spacing -->
                                    <a href="{{ route('cars.search') }}" class="btn custom-btn d-flex align-items-center">
                                        <span class="material-symbols-outlined me-1">
                                            search
                                        </span>
                                        Search for your dream car
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <!-- Use Bootstrap classes to style the clickable dropdown button -->
                                    <a id="navbarDropdown"
                                        class="nav-link dropdown-toggle btn btn-outline-primary custom-dropdown-button flex-row"
                                        href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        <img class="img-fluid rounded-circle me-2" width="38px" height="38px"
                                            src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                                            alt="Profile Picture">{{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end rounded-2" aria-labelledby="navbarDropdown">
                                        <div class="d-flex align-items-center justify-content-center mb-2">
                                            <span class="material-symbols-outlined ms-4"
                                                style="font-size:15px; font">account_circle</span>
                                            <a class="dropdown-item  "
                                                href="{{ route('user.profile', Auth::user()->id) }}">

                                                Profile
                                            </a>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-2">
                                            <span style="font-size:15px; font"
                                                class="material-symbols-outlined ms-4">logout</span>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                                {{ __('Logout') }}
                                            </a>
                                        </div>
                                    </div>

                                </li>

                                <!-- Second list item with horizontal spacing added -->
                                <li class="nav-item ms-3">
                                    <!-- Add margin-left (ms-3) class to create horizontal spacing -->
                                    <a href="{{ route('cars.create') }}" class="btn custom-btn d-flex align-items-center">
                                        <span class="material-symbols-outlined me-2">
                                            library_add
                                        </span>
                                        Create Car
                                    </a>
                                </li>
                            </ul>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                    </div>
                    </li>

                @endguest
                </ul>
            </div>
    </div>
    </nav>

    <main>
        @yield('content')
    </main>
    </div>
</body>

</html>
