@props([
    'id' => 'calendar-' . uniqid(),
    'eventsUrl' => '/api/calendar'
])

<div class="card bg-base-100 shadow-xl border border-base-200">
    <div class="card-body p-4 md:p-6">
        <h2 class="card-title mb-4 font-display text-xl text-base-content">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
            </svg>
            Kalender Kegiatan
        </h2>
        <div id="{{ $id }}" class="min-h-[500px]"></div>
    </div>
</div>

<!-- Modal for Event Details (DaisyUI Dialog) -->
<dialog id="modal_{{ $id }}" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box relative border-t-4 border-primary">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 id="title_{{ $id }}" class="font-bold text-xl text-primary mb-4 pb-2 border-b border-base-200">Detail Kegiatan</h3>
        
        <div class="flex flex-col gap-4">
            <div>
                <div class="text-xs font-bold uppercase text-base-content/50">Waktu Pelaksanaan</div>
                <div id="start_{{ $id }}" class="text-sm font-medium"></div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <div class="text-xs font-bold uppercase text-base-content/50">Tempat / Ruangan</div>
                    <div id="location_{{ $id }}" class="text-sm font-medium"></div>
                </div>
                <div>
                    <div class="text-xs font-bold uppercase text-base-content/50">Pengirim (Sender)</div>
                    <div id="sender_{{ $id }}" class="text-sm font-medium"></div>
                </div>
            </div>
            
            <div>
                <div class="text-xs font-bold uppercase text-base-content/50">Divisi Penugasan</div>
                <div id="division_{{ $id }}" class="text-sm font-bold text-accent"></div>
            </div>
            
            <div>
                <div class="text-xs font-bold uppercase text-base-content/50">Auditor yang Ditugaskan</div>
                <div id="auditors_{{ $id }}" class="text-sm font-medium mt-1 flex flex-wrap gap-1"></div>
            </div>
            
            <div>
                <div class="text-xs font-bold uppercase text-base-content/50">Status Pelaksanaan</div>
                <div id="status_{{ $id }}" class="mt-1"></div>
            </div>
            
            <div>
                <div class="text-xs font-bold uppercase text-base-content/50">Keterangan</div>
                <div id="description_{{ $id }}" class="text-sm italic text-base-content/70"></div>
            </div>
        </div>
        
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Tutup</button>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('{{ $id }}');
        if (!calendarEl) return;
        
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            locale: 'id',
            firstDay: 1,
            events: '{!! $eventsUrl !!}',
            eventClick: function(info) {
                const ext = info.event.extendedProps;
                
                document.getElementById('title_{{ $id }}').textContent = info.event.title || '-';
                
                const start = info.event.start;
                const formattedStart = start ? new Intl.DateTimeFormat('id-ID', {
                    weekday: 'long', year: 'numeric', month: 'long', day: 'numeric',
                    hour: 'numeric', minute: 'numeric', hour12: false
                }).format(start) + ' WIB' : '-';
                
                document.getElementById('start_{{ $id }}').textContent = formattedStart;
                document.getElementById('location_{{ $id }}').textContent = ext.location || '-';
                document.getElementById('sender_{{ $id }}').textContent = ext.sender || '-';
                document.getElementById('division_{{ $id }}').textContent = ext.division || 'Umum / Semua Divisi';
                
                const auditorsDiv = document.getElementById('auditors_{{ $id }}');
                auditorsDiv.innerHTML = '';
                if (ext.auditors && ext.auditors.length > 0) {
                    ext.auditors.forEach(function(auditor) {
                        const span = document.createElement('span');
                        span.className = 'badge badge-accent badge-sm font-semibold';
                        span.textContent = auditor;
                        auditorsDiv.appendChild(span);
                    });
                } else {
                    auditorsDiv.textContent = 'Belum Ditugaskan';
                }
                
                document.getElementById('description_{{ $id }}').textContent = ext.description || 'Tidak ada keterangan tambahan.';
                
                const status = ext.status_pelaksanaan || 'Pending';
                const statusDiv = document.getElementById('status_{{ $id }}');
                let badgeClass = 'badge-warning';
                if (status.toLowerCase() === 'selesai') badgeClass = 'badge-success';
                if (status.toLowerCase() === 'batal') badgeClass = 'badge-error';
                
                statusDiv.innerHTML = `<span class="badge ${badgeClass} font-bold">${status}</span>`;
                
                // Show modal using DaisyUI API
                document.getElementById('modal_{{ $id }}').showModal();
            }
        });
        calendar.render();
    });
</script>
