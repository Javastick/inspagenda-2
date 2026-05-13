@extends('layouts.app')

@section('title', 'Portal ' . $division->name)
@section('header_title', 'Portal Divisi: ' . $division->name)

@section('content')
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; margin-bottom: 24px;">
    <!-- Welcome banner -->
    <div class="card" style="background: linear-gradient(135deg, var(--bg-surface), var(--accent-light)); display: flex; align-items: center; justify-content: space-between; padding: 32px; border: 1px solid var(--accent-glow);">
        <div>
            <h2 style="font-size: 26px; font-weight: 800; margin-bottom: 8px;">Selamat Datang di Portal {{ $division->name }}</h2>
            <p style="color: var(--text-muted); font-size: 15px; max-width: 500px;">
                Kelola jadwal audit, distribusikan penugasan secara adil, dan pantau status pelaksanaan kegiatan audit divisi Anda.
            </p>
        </div>
        <div style="font-size: 64px; opacity: 0.15; font-family: var(--font-display); font-weight: 900;">
            {{ strtoupper(substr($division->name, 0, 2)) }}
        </div>
    </div>

    <!-- Workload Equalization (Pemerataan Beban Kerja Auditor) -->
    <div class="card" style="border: 1px solid var(--accent-glow);">
        <h3 class="card-title">
            <span>Beban Kerja Auditor</span>
            <span style="font-size: 12px; font-weight: 500; color: var(--accent); background-color: var(--accent-light); padding: 4px 10px; border-radius: 12px;">{{ $currentMonthName }}</span>
        </h3>
        <p style="font-size: 12px; color: var(--text-muted); margin-bottom: 16px;">
            Gunakan visualisasi ini untuk membagikan tugas audit secara merata (*Workload Equalization*).
        </p>

        <div class="auditor-badge-list">
            @foreach($division->auditors->sortBy('invite_mails_count') as $auditor)
                @php
                    // Assume 10 audits is maximum soft-cap per month
                    $maxCap = max(10, $division->auditors->max('invite_mails_count'));
                    $percentage = ($auditor->invite_mails_count / $maxCap) * 100;
                    
                    // Assign color based on workload
                    $barColor = 'var(--accent)';
                    if ($auditor->invite_mails_count > 5) {
                        $barColor = 'var(--warning)';
                    }
                    if ($auditor->invite_mails_count > 8) {
                        $barColor = 'var(--danger)';
                    }
                @endphp
                <div class="auditor-frequency-card">
                    <div style="flex-grow: 1; margin-right: 16px;">
                        <div style="display: flex; justify-content: space-between; font-weight: 600; font-size: 13.5px; margin-bottom: 4px;">
                            <span>{{ $auditor->name }}</span>
                            <span style="color: var(--text-muted);">{{ $auditor->invite_mails_count }} Audit</span>
                        </div>
                        <!-- Progress bar -->
                        <div style="width: 100%; height: 6px; background-color: var(--border-color); border-radius: 3px; overflow: hidden;">
                            <div style="width: {{ $percentage }}%; height: 100%; background-color: {{ $barColor }}; border-radius: 3px; transition: width 0.5s ease-out;"></div>
                        </div>
                    </div>
                    <div>
                        <span class="badge {{ $auditor->status == 'aktif' ? 'badge-success' : 'badge-danger' }}">{{ ucfirst($auditor->status) }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="grid-cols-1-3">
    <!-- List of Division Schedules -->
    <div class="card">
        <h3 class="card-title">Daftar Jadwal Divisi</h3>
        <p style="font-size: 12px; color: var(--text-muted); margin-bottom: 16px;">
            Menampilkan agenda audit khusus untuk Divisi {{ $division->name }}.
        </p>

        @if($schedules->isEmpty())
            <div style="text-align: center; padding: 40px 0; color: var(--text-muted);">
                <svg style="width: 48px; height: 48px; margin-bottom: 12px; opacity: 0.5;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-2.25-4.062-2.25-4.062 0v2.625c0 .621.504 1.125 1.125 1.125z"></path>
                </svg>
                <p style="font-weight: 600;">Tidak ada jadwal audit</p>
                <p style="font-size: 12px;">Divisi ini belum memiliki agenda terdaftar.</p>
            </div>
        @else
            <div style="display: flex; flex-direction: column; gap: 14px; max-height: 500px; overflow-y: auto; padding-right: 8px;">
                @foreach($schedules as $schedule)
                    @php
                        $statusClass = 'badge-warning';
                        if (strtolower($schedule->status_pelaksanaan) == 'selesai') $statusClass = 'badge-success';
                        if (strtolower($schedule->status_pelaksanaan) == 'batal') $statusClass = 'badge-danger';
                    @endphp
                    <div class="card" style="padding: 16px; margin-bottom: 0; background-color: var(--bg-app); border: 1px solid var(--border-color); display: flex; flex-direction: column; gap: 8px;">
                        <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                            <span style="font-weight: 700; font-size: 14.5px; color: var(--text-main);">{{ $schedule->kegiatan }}</span>
                            <span class="badge {{ $statusClass }}" style="font-size: 10px;">{{ $schedule->status_pelaksanaan ?? 'Pending' }}</span>
                        </div>
                        <div style="font-size: 12.5px; color: var(--text-muted); display: flex; flex-direction: column; gap: 4px;">
                            <span style="display: flex; align-items: center; gap: 6px;">
                                <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $schedule->hari ? $schedule->hari->isoFormat('dddd, D MMMM YYYY - HH:mm') . ' WIB' : '-' }}
                            </span>
                            <span style="display: flex; align-items: center; gap: 6px;">
                                <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1115 0z"></path>
                                </svg>
                                {{ $schedule->tempat }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Interactive Calendar Widget -->
    <div class="card">
        <h3 class="card-title">Kalender Kegiatan Divisi</h3>
        <div id="division-calendar" style="min-height: 500px;"></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('division-calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek'
            },
            locale: 'id',
            firstDay: 1,
            // Fetch events filtered specifically for this division
            events: '/api/calendar?division_id={{ $division->id }}',
            eventClick: function(info) {
                openEventModal(info);
            }
        });
        calendar.render();
    });
</script>
@endsection
