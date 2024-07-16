<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('Manajemen Resto', 'Manajemen Resto') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" id="menu-nav" href="{{ route('menus.index') }}">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="customer-nav" href="{{ route('customers.index') }}">Customer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="order-nav" href="{{ route('orders.index') }}">Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reservation-nav" href="{{ route('reservations.index') }}">Reservasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="employee-nav" href="{{ route('employees.index') }}">Karyawan</a>
                        </li>
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
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

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

        <main class="py-4">
            @if (session('alert'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('alert') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        // JavaScript to make navbar link active
        document.addEventListener('DOMContentLoaded', function () {
            const currentPath = window.location.pathname;

            // Define path and corresponding element IDs
            const navLinks = [
                { path: '/menus', id: 'menu-nav' },
                { path: '/customers', id: 'customer-nav' },
                { path: '/orders', id: 'order-nav' },
                { path: '/reservations', id: 'reservation-nav' },
                { path: '/employees', id: 'employee-nav' }
            ];

            // Loop through the navLinks to find the current path
            navLinks.forEach(link => {
                if (currentPath.startsWith(link.path)) {
                    document.getElementById(link.id).classList.add('active');
                }
            });
        });
    </script>
</body>

</html>
