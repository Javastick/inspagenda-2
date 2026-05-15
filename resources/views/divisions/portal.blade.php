@extends('layouts.app')

@section('content')
<div class="header">
    <div>
        <h1>Portal Divisi: {{ $division->name }}</h1>
        <p style="color: #64748b; margin-top: 0.5rem;">Jadwal Pemeriksaan & Penugasan Auditor</p>
    </div>
    <div style="text-align: right;">
        <span style="font-weight: 600; color: #4f46e5;">{{ $currentMonthName }}</span>
    </div>
</div>

<div id="calendar"></div>

<!-- Event Detail Modal (Subtle implementation) -->
<div id="eventModal" style="display:none; position:fixed; z-index:100; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.5); align-items:center; justify-content:center;">
    <div style="background:white; padding:2rem; border-radius:1rem; max-width:500px; width:90%; position:relative;">
        <h2 id="modalTitle" style="margin-top:0; font-weight:700;"></h2>
        <div id="modalBody" style="margin-top:1rem; line-height:1.6;"></div>
        <button onclick="document.getElementById('eventModal').style.display='none'" style="margin-top:1.5rem; padding:0.5rem 1rem; background:var(--primary); color:white; border:none; border-radius:0.5rem; cursor:pointer;">Tutup</button>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'id',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listMonth'
            },
            // Fetch events asynchronously from the API
            events: '/api/calendar',
            
            eventClick: function(info) {
                var props = info.event.extendedProps;
                var modal = document.getElementById('eventModal');
                var title = document.getElementById('modalTitle');
                var body = document.getElementById('modalBody');

                title.innerText = info.event.title;
                body.innerHTML = `
                    <p><strong>Lokasi:</strong> ${props.location || '-'}</p>
                    <p><strong>Pengirim:</strong> ${props.sender || '-'}</p>
                    <p><strong>Auditor:</strong> ${props.auditors.join(', ') || 'Belum ditugaskan'}</p>
                    <p><strong>Keterangan:</strong> ${props.description || '-'}</p>
                    <p><strong>Status:</strong> ${props.status_pelaksanaan || 'Pending'}</p>
                `;
                modal.style.display = 'flex';
            }
        });
        calendar.render();
    });
</script>
@endsection
