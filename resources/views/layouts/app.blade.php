<!DOCTYPE html>
<html lang="en" {{ auth()?->user()->theme == 'dark' ? 'data-coreui-theme=dark' : '' }}>

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="{{ config('app.name', 'Laravel') }}">
    <meta name="og:title" property="og:title" content="{{ config('app.name', 'Laravel') }}">
    <meta name="og:description" property="og:description" content="{{ config('app.name', 'Laravel') }}">
    <meta name="og:image" property="og:image" content="{{ asset('img/logo.png') }}">
    <meta name="og:url" property="og:url" content="{{ url()->current() }}">
    @vite('resources/sass/app.scss')
    @livewireStyles
    @livewireChartsScripts
</head>

<body>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <img src="{{ asset('img/logo.png') }}" alt="logo" class="m-2 sidebar-brand-full w-25 ms-auto me-auto">

            <img src="{{ asset('img/logo.png') }}" alt="logo" class="m-2 sidebar-brand-narrow w-25">

        </div>
        @include('layouts.navigation')
    </div>
    <div class="wrapper d-flex flex-column min-vh-100">
        <header class="mb-4 header header-sticky">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <!-- Bottone menu -->
                <button class="header-toggler px-md-0 me-md-3" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <svg class="icon icon-lg">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-menu') }}"></use>
                    </svg>
                </button>

                <!-- Logo -->
                <a class="mx-auto text-center header-brand d-md-none" href="#">
                    <img src="{{ asset('img/logo.png') }}" alt="logo" class="m-2 sidebar-brand-full w-25">
                </a>

                <!-- Menu Utente -->
                <ul class="header-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="py-0 nav-link d-flex align-items-center" data-coreui-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <svg class="icon me-2">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                            </svg>
                            <span class="d-none d-md-inline">{{ Auth::user()->name }} ({{ Auth::user()->roles->first()->name }})</span>
                        </a>
                        <div class="pt-0 dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                <svg class="icon me-2">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                                </svg>
                                {{ __('My profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('toggle.theme') }}">
                                <svg class="icon me-2">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-moon') }}"></use>
                                </svg>
                                {{ __('Toggle Theme') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-account-logout') }}"></use>
                                    </svg>
                                    {{ __('Logout') }}
                                </a>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        <div class="px-3 body flex-grow-1">
            <div class="container-lg">
                @yield('content')
            </div>
        </div>

    </div>
    @vite('resources/js/app.js')
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>

    @include('sweetalert::alert')

    @yield('scripts')

    @livewireScripts

</body>

</html>
