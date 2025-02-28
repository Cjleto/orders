<!DOCTYPE html>
<html lang="it">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" type="image/png" href="{{ asset('img/logolight.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="theme-color" content="#ffffff">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <meta name="og:title" property="og:title" content="Menulight">
    <meta name="og:description" property="og:description" content="Menulight">
    <meta name="og:image" property="og:image" content="{{ asset('img/logo.png') }}">
    <meta name="og:url" property="og:url" content="{{ url()->current() }}">
    @vite('resources/sass/app.scss')
</head>
<body>

    <!-- Navbar o Header -->
    {{-- <header>
        <nav>
            <!-- Aggiungi qui il tuo menu di navigazione -->
        </nav>
    </header> --}}

    <!-- Contenuto principale -->
    <main class="p-0 container-fluid">
        {{ $slot }}
    </main>

    @livewireScripts
    <!-- Aggiungi i tuoi script JS qui -->
    @vite('resources/js/app.js')
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script> --}}

    @yield('scripts')

</body>
</html>
