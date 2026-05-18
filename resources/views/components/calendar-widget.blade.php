@props([
    'mode'       => 'home',      // 'home' or 'division'
    'divisionId' => null,
])

<div class="card bg-base-100 shadow-sm border border-base-200">
    <div class="card-body p-4 md:p-6">
        <div id="calendar" class="w-full"></div>
    </div>
</div>

<!-- Event Detail Modal (DaisyUI structure) -->
<dialog id="eventModal" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 id="modalTitle" class="font-bold text-lg mb-4 text-primary"></h3>
        <div id="modalBody" class="space-y-2 text-sm">
            <!-- Modal content injected via JS -->
        </div>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn btn-primary">Tutup</button>
            </form>
        </div>
    </div>
</dialog>

@once
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        if (!calendarEl) return;

        // Determine API endpoint based on page context
        const calendarMode    = @json($mode);
        const calendarDivId   = @json($divisionId);
        const eventsUrl = (calendarMode === 'division' && calendarDivId)
            ? `/api/calendar/division/${calendarDivId}`
            : '/api/calendar';

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'id',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listMonth'
            },
            events: eventsUrl,

            eventClick: function(info) {
                const props = info.event.extendedProps;
                const modal = document.getElementById('eventModal');
                const title = document.getElementById('modalTitle');
                const body  = document.getElementById('modalBody');

                title.innerText = info.event.title;

                // Determine status badge style
                let statusBadgeClass = 'badge-warning';
                if (props.status === 'Terlewat')  statusBadgeClass = 'badge-ghost';
                if (props.status === 'Hari Ini')  statusBadgeClass = 'badge-success';

                // Auditor row — only shown in division mode
                const auditorRow = (calendarMode === 'division') ? `
                    <div class="grid grid-cols-3 gap-2 border-b pb-2">
                        <span class="font-semibold text-base-content/70">Auditor</span>
                        <span class="col-span-2">${props.auditors && props.auditors.length > 0 ? props.auditors.join(', ') : 'Belum ditugaskan'}</span>
                    </div>
                ` : '';

                body.innerHTML = `
                    <div class="grid grid-cols-3 gap-2 border-b pb-2">
                        <span class="font-semibold text-base-content/70">Lokasi</span>
                        <span class="col-span-2">${props.location || '-'}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-2 border-b pb-2">
                        <span class="font-semibold text-base-content/70">Pengirim</span>
                        <span class="col-span-2">${props.sender || '-'}</span>
                    </div>
                    ${auditorRow}
                    <div class="grid grid-cols-3 gap-2 border-b pb-2">
                        <span class="font-semibold text-base-content/70">Status</span>
                        <span class="col-span-2">
                            <div class="badge ${statusBadgeClass} gap-2">${props.status || 'Mendatang'}</div>
                        </span>
                    </div>
                    <div class="grid grid-cols-1 gap-1 pt-2">
                        <span class="font-semibold text-base-content/70">Keterangan</span>
                        <p class="bg-base-200 p-3 rounded-lg mt-1">${props.description || 'Tidak ada keterangan.'}</p>
                    </div>
                `;
                modal.showModal();
            }
        });
        calendar.render();
    });
</script>
@endpush
@endonce
