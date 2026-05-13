<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf-token() }}">
    <title>@yield('title', 'Inspagenda-2') - Audit & Schedule</title>

    <!-- Vite Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FullCalendar Standard CDN -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

    @yield('styles')
</head>
<body>
    <div class="app-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="brand">
                <div class="brand-icon">I</div>
                <div class="brand-name">Inspagenda<span style="color: var(--accent);">2</span></div>
            </div>

            <ul class="nav-menu">
                <li>
                    <a href="{{ route('schedules.index') }}" class="nav-item {{ request()->routeIs('schedules.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"></path>
                        </svg>
                        Semua Jadwal
                    </a>
                </li>

                <!-- Dynamic Division Portals -->
                <li style="margin-top: 16px; margin-bottom: 8px;">
                    <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: var(--text-muted); padding: 0 16px;">Portal Divisi</span>
                </li>

                @php
                    $sidebarDivisions = \App\Models\Division::all();
                @endphp

                @foreach($sidebarDivisions as $div)
                    <li>
                        <a href="{{ route('division.portal', $div->id) }}" class="nav-item {{ request()->url() == route('division.portal', $div->id) ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21h10.5V3.75c0-.621-.504-1.125-1.125-1.125H7.875c-.621 0-1.125.504-1.125 1.125V21z"></path>
                            </svg>
                            {{ $div->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="sidebar-footer">
                @auth
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-item" style="color: var(--danger);">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"></path>
                        </svg>
                        Log Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-item" style="color: var(--accent);">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"></path>
                        </svg>
                        Log In
                    </a>
                @endauth
            </div>
        </aside>

        <!-- Main Workspace -->
        <main class="main-content">
            <!-- Header section -->
            <header class="top-header">
                <div class="page-title">
                    @yield('header_title', 'Dashboard')
                </div>

                <div class="header-actions">
                    <!-- Light / Dark Mode Toggle -->
                    <button class="btn-theme-toggle" id="theme-toggle" onclick="toggleTheme()" title="Ganti Tema">
                        <!-- Sun Icon -->
                        <svg id="theme-icon-sun" style="display:none; width: 20px; height: 20px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m0 13.5V21M4.22 4.22l1.58 1.58m12.42 12.42l1.58 1.58M3 12h2.25m13.5 0H21m-2.25-7.78l-1.58 1.58M6.78 17.22l-1.58 1.58M12 7.5a4.5 4.5 0 110 9 4.5 4.5 0 010-9z"></path>
                        </svg>
                        <!-- Moon Icon -->
                        <svg id="theme-icon-moon" style="display:none; width: 20px; height: 20px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"></path>
                        </svg>
                    </button>

                    <!-- Profile Info -->
                    @auth
                        <div class="user-profile">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="user-info">
                                <div class="user-name">{{ Auth::user()->name }}</div>
                                <div class="user-role">{{ ucfirst(Auth::user()->role) }}</div>
                            </div>
                        </div>
                    @endauth
                </div>
            </header>

            <!-- Page Body -->
            <section class="content-body">
                @if(session('success'))
                    <div class="card badge-success" style="padding: 16px; margin-bottom: 24px; border: 1px solid var(--success); font-weight: 500;">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </section>
        </main>
    </div>

    <!-- Event Detail Modal -->
    <div class="modal-overlay" id="event-detail-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-event-title">Detail Kegiatan</h3>
                <button class="modal-close" onclick="closeEventModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-info-item">
                    <span class="modal-info-label">Nama Kegiatan</span>
                    <span class="modal-info-value" id="modal-val-title" style="font-size: 18px; font-weight: 700; color: var(--accent);"></span>
                </div>
                <div class="modal-info-item">
                    <span class="modal-info-label">Waktu Pelaksanaan (Hari/Jam)</span>
                    <span class="modal-info-value" id="modal-val-start"></span>
                </div>
                <div class="modal-info-item">
                    <span class="modal-info-label">Tempat / Ruangan</span>
                    <span class="modal-info-value" id="modal-val-location"></span>
                </div>
                <div class="modal-info-item">
                    <span class="modal-info-label">Pengirim Undangan (Sender)</span>
                    <span class="modal-info-value" id="modal-val-sender"></span>
                </div>
                <div class="modal-info-item">
                    <span class="modal-info-label">Divisi Penugasan</span>
                    <span class="modal-info-value" id="modal-val-division"></span>
                </div>
                <div class="modal-info-item">
                    <span class="modal-info-label">Auditor yang Ditugaskan</span>
                    <span class="modal-info-value" id="modal-val-auditors"></span>
                </div>
                <div class="modal-info-item">
                    <span class="modal-info-label">Keterangan Tambahan</span>
                    <span class="modal-info-value" id="modal-val-description" style="font-style: italic; color: var(--text-muted);"></span>
                </div>
                <div class="modal-info-item">
                    <span class="modal-info-label">Status Pelaksanaan</span>
                    <span class="modal-info-value" id="modal-val-status"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Layout Logic Scripts -->
    <script>
        // Set initial theme
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            document.getElementById('theme-icon-sun').style.display = 'block';
        } else {
            document.documentElement.classList.remove('dark');
            document.getElementById('theme-icon-moon').style.display = 'block';
        }

        // Toggle Theme
        function toggleTheme() {
            const isDark = document.documentElement.classList.contains('dark');
            if (isDark) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                document.getElementById('theme-icon-sun').style.display = 'none';
                document.getElementById('theme-icon-moon').style.display = 'block';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                document.getElementById('theme-icon-moon').style.display = 'none';
                document.getElementById('theme-icon-sun').style.display = 'block';
            }
        }

        // Show Modal with detail
        function openEventModal(eventInfo) {
            const ext = eventInfo.event.extendedProps;
            
            document.getElementById('modal-val-title').textContent = eventInfo.event.title || '-';
            
            // Format start time nicely
            const start = eventInfo.event.start;
            const formattedStart = start ? new Intl.DateTimeFormat('id-ID', {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric',
                hour: 'numeric', minute: 'numeric', hour12: false
            }).format(start) + ' WIB' : '-';
            document.getElementById('modal-val-start').textContent = formattedStart;
            
            document.getElementById('modal-val-location').textContent = ext.location || '-';
            document.getElementById('modal-val-sender').textContent = ext.sender || '-';
            document.getElementById('modal-val-division').textContent = ext.division || 'Umum / Semua Divisi';
            
            const auditors = ext.auditors && ext.auditors.length > 0 ? ext.auditors.join(', ') : 'Belum Ditugaskan';
            document.getElementById('modal-val-auditors').textContent = auditors;
            
            document.getElementById('modal-val-description').textContent = ext.description || 'Tidak ada keterangan tambahan.';
            
            const status = ext.status_pelaksanaan || 'Pending';
            const statusBadge = document.getElementById('modal-val-status');
            statusBadge.textContent = status;
            statusBadge.className = 'modal-info-value badge';
            
            if (status.toLowerCase() === 'selesai' || status.toLowerCase() === 'done' || status.toLowerCase() === 'completed') {
                statusBadge.classList.add('badge-success');
            } else if (status.toLowerCase() === 'batal' || status.toLowerCase() === 'canceled') {
                statusBadge.classList.add('badge-danger');
            } else {
                statusBadge.classList.add('badge-warning');
            }

            document.getElementById('event-detail-modal').classList.add('active');
        }

        function closeEventModal() {
            document.getElementById('event-detail-modal').classList.remove('active');
        }

        // Close on escape or clicking outside
        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeEventModal();
        });
        document.getElementById('event-detail-modal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('event-detail-modal')) closeEventModal();
        });
    </script>
    @yield('scripts')
</body>
</html>
