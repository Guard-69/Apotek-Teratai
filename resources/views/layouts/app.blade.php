<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') &middot; {{ config('app.name') }}</title>
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ctext y='.9em' font-size='90'%3E%F0%9F%92%8A%3C/text%3E%3C/svg%3E">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
</head>
<body>
    <header class="navbar">
        <div class="container">
            <a href="{{ route('beranda') }}" class="brand">
                <span class="brand-mark">&#128138;</span>
                {{ config('app.name') }}
            </a>

            <button type="button" class="nav-toggle" id="navToggle" aria-label="Buka menu" aria-expanded="false" aria-controls="navMenu">
                <span></span><span></span><span></span>
            </button>

            <nav class="nav-menu" id="navMenu" aria-label="Menu utama">
                <a href="{{ route('beranda') }}" class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('pelanggan.index') }}" class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">Pelanggan</a>
                <a href="{{ route('staf.index') }}" class="nav-link {{ request()->routeIs('staf.*') ? 'active' : '' }}">Staf Apotek</a>
                <a href="{{ route('obat.index') }}" class="nav-link {{ request()->routeIs('obat.*') ? 'active' : '' }}">Daftar Obat</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="container page">
            @if (session('success'))
                <div class="alert alert-success" role="status" data-autohide>
                    <div class="alert-body">{{ session('success') }}</div>
                    <button type="button" class="alert-close" data-dismiss aria-label="Tutup">&times;</button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <span>&copy; {{ date('Y') }} {{ config('app.name') }}</span>
            <span>Dibuat dengan sepenuh hati</span>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}?v={{ filemtime(public_path('js/app.js')) }}" defer></script>
</body>
</html>
