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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* CSS for hiding elements on print */
        @media print {
            .no-print {
                display: none;
                height: 0;
                /* Ensure it doesn't take up space */
                margin: 0;
                padding: 0;
            }

            .table td {
                height: 10px;
                /* Adjust height as needed */
            }

            .table td {
                padding: 3px !important;
                /* Adjust padding as needed */
            }
        }

        /* Reduce the padding inside the table cells */
        .table td {
            padding: 3px !important;
            /* Adjust padding as needed */
        }

        /* Optionally set a fixed height for the table cells */
        .table td {
            height: 10px;
            /* Adjust height as needed */
        }
    </style>
    @yield('css')
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'public/vendor/laratrust/laratrust.css'])
</head>

<body>
    <div id="app">
        <nav class="no-print navbar navbar-expand-md bg-gray-800 no-print">
            <div class="container-fluid">
                <a class="navbar-brand text-white no-print" href="{{ url('/') }}">
                    <img src="{{ asset('logo.png') }}" alt="logo" width="250px" height="50px">
                </a>
                <button class="no-print navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class=" {{ Request::routeIs('home') ? 'nav-button-active' : 'nav-button' }}" href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class=" {{ Request::routeIs('proforma.index') || Request::routeIs('proforma.create') || Request::routeIs('proforma.show') || Request::routeIs('proforma.edit') ? 'nav-button-active' : 'nav-button' }}" href="{{ route('proforma.index') }}">
                                Proforma Invoice
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="ml-4 {{ Request::routeIs('clients.index') || Request::routeIs('clients.create') || Request::routeIs('clients.edit') || Request::routeIs('clients.show') ? 'nav-button-active' : 'nav-button' }}" href="{{ route('clients.index') }}">
                                Clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="ml-4 {{ Request::routeIs('items.index') || Request::routeIs('items.create') || Request::routeIs('items.edit') || Request::routeIs('items.show') ? 'nav-button-active' : 'nav-button' }}" href="{{ route('items.index') }}">
                                Items
                            </a>
                        </li>
                        @auth
                        @if(Auth::user()->hasRole(['administrator']))
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown text-white" class="ml-4  text-white dropdown-toggle {{ Request::routeIs('users.index')  ? 'nav-button-active' : 'nav-button' }}" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('User Management') }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('users.index') }}">
                                    {{ __('Users') }}
                                </a>
                                <a class="dropdown-item" href="{{url('roles-assignment')}}">
                                    {{ __('Roles Assignment') }}
                                </a>
                            </div>
                        </li>
                        @endif
                        @endauth
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="{{ Request::routeIs('login') ? 'nav-button-active' : 'nav-button' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="{{ Request::routeIs('register') ? 'nav-button-active' : 'nav-button' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown text-white" class="nav-link text-white dropdown-toggle 
                            {{ Request::routeIs('password.change') ? 'nav-button-active' : 'nav-button' }}" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('password.change')}}">{{ __('Change Password') }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}
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
            @yield('content')
        </main>
    </div>
    @yield('script')
</body>
</html>