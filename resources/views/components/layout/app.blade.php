<!DOCTYPE html>
<html lang="id" data-theme="inspagenda">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Inspagenda-2' }}</title>

    <!-- Vite Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FullCalendar Standard CDN -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
</head>
<body class="min-h-screen bg-base-200 text-base-content flex flex-col font-sans">
    <!-- Navbar -->
    <div class="navbar bg-base-100 shadow-sm sticky top-0 z-50">
        <div class="flex-1">
            <a href="/" class="btn btn-ghost normal-case text-xl font-display font-bold">
                <span class="bg-primary text-primary-content w-8 h-8 rounded flex items-center justify-center mr-1 shadow-sm">I</span>
                Inspagenda<span class="text-primary">2</span>
            </a>
        </div>
        <div class="flex-none hidden lg:flex">
            <ul class="menu menu-horizontal px-1 font-medium">
                <li><a href="/" class="{{ request()->is('/') ? 'active text-primary' : '' }}">Beranda</a></li>
                <li><a href="/home" class="{{ request()->is('home') ? 'active text-primary' : '' }}">Kalender Utama</a></li>
                <li><a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active text-primary' : '' }}">Dashboard Admin</a></li>
                <li>
                    <details>
                        <summary>Portal Divisi</summary>
                        <ul class="p-2 bg-base-100 rounded-t-none w-48 shadow-lg">
                            @foreach(\App\Models\Division::all() as $div)
                                <li><a href="/portal/division/{{ $div->id }}">{{ $div->name }}</a></li>
                            @endforeach
                        </ul>
                    </details>
                </li>
            </ul>
        </div>
        <div class="flex-none">
            @auth
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full bg-primary/20 text-primary flex items-center justify-center font-bold text-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </label>
                    <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                        <li class="menu-title px-4 py-2">
                            <span class="block text-sm font-bold text-base-content">{{ Auth::user()->name }}</span>
                            <span class="block text-xs text-base-content/60">{{ ucfirst(Auth::user()->role) }}</span>
                        </li>
                        <div class="divider my-0"></div>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="text-error w-full text-left">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm ml-2">Login</a>
            @endauth
        </div>
    </div>

    <!-- Main Content Slot -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="footer footer-center p-6 bg-base-100 text-base-content mt-12 border-t border-base-300">
        <aside>
            <p class="font-medium">© {{ date('Y') }} Inspagenda-2. Dirancang dengan DaisyUI.</p>
        </aside>
    </footer>

    <!-- Global Scripts (like modal close handlers) -->
    <script>
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const modals = document.querySelectorAll('dialog.modal[open]');
                modals.forEach(m => m.close());
            }
        });
    </script>
    {{ $scripts ?? '' }}
</body>
</html>
