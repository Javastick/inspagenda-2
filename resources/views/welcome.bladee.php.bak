<!DOCTYPE html>
<html lang="id" data-theme="mytheme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Inspagenda - Sistem Penjadwalan Pemeriksaan Inspektorat">
    <title>Inspagenda - Sistem Informasi Jadwal Pemeriksaan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-base-100 text-base-content min-h-screen flex flex-col">

    <!-- Navbar -->
    <div class="navbar bg-base-100/80 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-base-200">
        <div class="container mx-auto px-4 flex">
            <div class="flex-1">
                <a href="/" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo-inspagenda-nobg.png') }}" alt="Logo" class="h-8 w-auto">
                    <span class="font-bold text-lg text-base-content">Inspagenda</span>
                </a>
            </div>
            <div class="flex-none gap-2">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm">Dashboard Admin</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Login Admin</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <main class="flex-grow">
        <section class="relative min-h-[85vh] flex items-center overflow-hidden bg-gradient-to-br from-base-100 via-base-200 to-base-100">
            <!-- Decorative background -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-40 -right-40 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>
            </div>

            <div class="container mx-auto px-4 py-20 relative z-10">
                <div class="flex flex-col lg:flex-row items-center gap-16">
                    <!-- Hero Text -->
                    <div class="flex-1 text-center lg:text-left">
                        <div class="badge badge-outline badge-warning mb-4 font-medium">INSPAGENDA</div>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                            Inspektorat Daerah Kabupaten <br class="hidden md:block">
                            <span class="text-primary">Brebes</span><br class="hidden md:block">
                            
                        </h1>
                        <p class="text-base-content/70 text-lg md:text-xl max-w-xl mx-auto lg:mx-0 mb-10">
                            Platform terpusat untuk pengelolaan, penjadwalan, dan pemerataan tugas auditor Inspektorat secara transparan dan terstruktur.
                        </p>

                        <!-- 3 CTA Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="{{ route('calendar') }}" class="btn btn-primary btn-lg shadow-lg shadow-primary/30 hover:shadow-primary/50 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                Lihat Jadwal
                            </a>
                            <a href="{{ Auth::check() ? route('admin.surat.create') : route('login') }}" class="btn btn-outline btn-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                Input Surat
                            </a>
                        </div>
                    </div>

                    <!-- Portal Divisi Grid -->
                    <div class="flex-1 w-full max-w-md lg:max-w-none">
                        <div class="bg-base-100 rounded-2xl shadow-xl border border-base-200 p-6">
                            <h2 class="font-bold text-lg mb-4 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                Portal Divisi Irban
                            </h2>
                            <div class="grid grid-cols-2 gap-3">
                                @php
                                    $divisions = \App\Models\Division::all();
                                @endphp
                                @forelse($divisions as $division)
                                    <a href="{{ route('division.portal', $division->id) }}"
                                       class="card bg-base-200 hover:bg-primary/10 hover:border-primary border border-transparent transition-all duration-200 cursor-pointer p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center">
                                                    <span class="text-primary font-bold text-sm">{{ substr($division->name, -1) }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-sm">{{ $division->name }}</p>
                                                <p class="text-xs text-base-content/60">Inspektorat Pembantu</p>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="col-span-2 text-center py-8 text-base-content/50">
                                        <p class="text-sm">Belum ada divisi terdaftar.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Bar -->
        <!-- <section class="bg-base-200 border-t border-base-300">
            <div class="container mx-auto px-4 py-8">
                <div class="stats stats-vertical md:stats-horizontal shadow w-full bg-base-100">
                    <div class="stat">
                        <div class="stat-figure text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                        <div class="stat-title">Total Jadwal</div>
                        <div class="stat-value text-primary">{{ \App\Models\InviteMail::count() }}</div>
                        <div class="stat-desc">Surat Undangan Pemeriksaan</div>
                    </div>
                    <div class="stat">
                        <div class="stat-figure text-success">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <div class="stat-title">Total Auditor</div>
                        <div class="stat-value text-success">{{ \App\Models\Auditor::count() }}</div>
                        <div class="stat-desc">Aktif & Terdaftar</div>
                    </div>
                    <div class="stat">
                        <div class="stat-figure text-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                        <div class="stat-title">Divisi Irban</div>
                        <div class="stat-value text-warning">{{ \App\Models\Division::count() }}</div>
                        <div class="stat-desc">Inspektorat Pembantu</div>
                    </div>
                </div>
            </div>
        </section> -->
    </main>

    <!-- Footer -->
    <footer class="footer footer-center p-6 bg-base-100 border-t border-base-200 text-base-content/60">
        <aside>
            <p>Copyright © {{ date('Y') }} · <strong>Inspagenda</strong> · Inspektorat Daerah Kabupaten Brebes</p>
        </aside>
    </footer>

</body>
</html>
