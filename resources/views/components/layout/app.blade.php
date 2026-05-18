<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="mytheme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Inspagenda') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

    <!-- Flatpickr CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

    <!-- Vite Assets (Tailwind & DaisyUI) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-base-200 text-base-content min-h-screen flex flex-col">
    
    <!-- Navbar -->
    <div class="navbar bg-base-100 shadow-sm sticky top-0 z-50">
        <div class="flex-1">
            <a href="/" class="btn btn-ghost text-xl">
                <img src="{{ asset('images/logo-inspagenda-nobg.png') }}" alt="Inspagenda Logo" class="h-8 w-auto mr-2">
                Inspagenda
            </a>
        </div>
        <div class="flex-none gap-2">
            @auth
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full border border-primary">
                        <img alt="User Profile" src="{{ asset('images/logo-inspagenda-512px.png') }}" />
                    </div>
                </div>
                <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-left">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
            @endauth
        </div>
    </div>

    <!-- Main Content Slot -->
    <main class="flex-grow container mx-auto p-4 md:p-6 lg:p-8">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="footer footer-center p-4 bg-base-100 text-base-content border-t border-base-300">
        <aside>
            <p>Copyright © {{ date('Y') }} - Inspagenda System. All rights reserved.</p>
        </aside>
    </footer>

    @stack('scripts')
</body>
</html>
