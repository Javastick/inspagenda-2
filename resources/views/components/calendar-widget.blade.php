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
        if(calendarEl) {
            const calendar = new FullCalendar.Calendar(calendarEl, {
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
                    const props = info.event.extendedProps;
                    const modal = document.getElementById('eventModal');
                    const title = document.getElementById('modalTitle');
                    const body = document.getElementById('modalBody');

                    title.innerText = info.event.title;
                    body.innerHTML = `
                        <div class="grid grid-cols-3 gap-2 border-b pb-2">
                            <span class="font-semibold text-base-content/70">Lokasi</span>
                            <span class="col-span-2">${props.location || '-'}</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2 border-b pb-2">
                            <span class="font-semibold text-base-content/70">Pengirim</span>
                            <span class="col-span-2">${props.sender || '-'}</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2 border-b pb-2">
                            <span class="font-semibold text-base-content/70">Auditor</span>
                            <span class="col-span-2">${props.auditors && props.auditors.length > 0 ? props.auditors.join(', ') : 'Belum ditugaskan'}</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2 border-b pb-2">
                            <span class="font-semibold text-base-content/70">Status</span>
                            <span class="col-span-2">
                                <div class="badge ${props.status_pelaksanaan === 'Selesai' ? 'badge-success' : 'badge-warning'} gap-2">
                                    ${props.status_pelaksanaan || 'Pending'}
                                </div>
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
        }
    });
</script>
@endpush
@endonce
