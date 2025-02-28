<!DOCTYPE html>
<html lang="en" {{ auth()?->user()->theme == 'dark' ? 'data-coreui-theme=dark' : '' }}  >
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" type="image/png" href="{{ asset('img/logolight.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="theme-color" content="#ffffff">

    @vite('resources/sass/app.scss')

</head>
<body>
<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        {{-- <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('icons/brand.svg#full') }}"></use>
        </svg> --}}
        {{-- <div class="mr-2">
            <svg class="mr-2 sidebar-brand-full" width="25" height="26" alt="Logo">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-restaurant') }}"></use>
            </svg>
        </div>
        <div class="m-3 text-red-500 sidebar-brand-full text-info">Menulight</div> --}}
        <img src="{{ asset('img/logo.png') }}" alt="logo" class="m-2 sidebar-brand-full w-25" width="" >

        <img src="{{ asset('img/logo.png') }}" alt="logo" class="m-2 sidebar-brand-narrow w-25" width="" >
        {{-- <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('icons/brand.svg#signet') }}"></use>
        </svg> --}}
    </div>
    @include('layouts.navigation')
    {{-- <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button> --}}
</div>
<div class="wrapper d-flex flex-column min-vh-100">
    <header class="mb-4 header header-sticky">
        <div class="container-fluid">
            <button class="header-toggler px-md-0 me-md-3" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                <svg class="icon icon-lg">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-menu') }}"></use>
                </svg>
            </button>
            <a class="header-brand d-md-none" href="#">
                <img src="{{ asset('img/logo.png') }}" alt="logo" class="m-2 sidebar-brand-full w-25" width="" >
                {{-- <svg width="118" height="46" alt="CoreUI Logo">
                    <use xlink:href="{{ asset('icons/brand.svg#full') }}"></use>
                </svg> --}}
            </a>
            {{-- <ul class="header-nav d-none d-md-flex">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Dashboard</a></li>
            </ul> --}}
            <ul class="header-nav ms-auto">
                @impersonating()
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('impersonate.leave') }}">
                            <svg class="icon me-2">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-account-logout') }}"></use>
                            </svg>
                            {{ __('Leave impersonation') }}
                        </a>
                    </li>
                @endImpersonating
            </ul>
            <ul class="header-nav ms-3 d-none d-md-block">
                <li class="nav-item dropdown">
                    <a class="py-0 nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                        </svg>
                        {{ Auth::user()->name }} ({{ Auth::user()->roles->first()->name }})
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

        <div class="{{ $containerClass ?? 'container-fluid' }}">
            {{ $slot }}
        </div>
    </div>
    {{-- <footer class="footer">
        <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a> &copy; 2021
            creativeLabs.
        </div>
        <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/bootstrap/ui-components/">CoreUI UI
                Components</a></div>
    </footer> --}}
</div>
<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>


@include('sweetalert::alert')
@vite('resources/js/app.js')
@yield('scripts')

</body>
</html>
