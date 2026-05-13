@extends('layouts.app')

@section('title', 'Jadwal Audit')
@section('header_title', 'Dashboard Jadwal Audit')

@section('content')
@php
    $divisions = \App\Models\Division::all();
    $auditors = \App\Models\Auditor::all();
@endphp

<div class="grid-cols-1-3">
    <!-- Form Tambah Jadwal Baru (Left side) -->
    <div class="card">
        <h3 class="card-title">
            <span>Tambah Jadwal</span>
            <svg style="width: 20px; height: 20px; color: var(--accent);" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
            </svg>
        </h3>

        <form action="{{ route('schedules.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Nama Kegiatan / Agenda</label>
                <input type="text" name="kegiatan" class="form-input" placeholder="Contoh: Audit Mutu Internal" required>
            </div>

            <div class="form-group">
                <label class="form-label">Pengirim Undangan (Sender)</label>
                <input type="text" name="sender" class="form-input" placeholder="Contoh: Rektorat / Dekan" required>
            </div>

            <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                <div>
                    <label class="form-label">Tanggal Masuk Surat</label>
                    <input type="date" name="masuk" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Waktu Pelaksanaan</label>
                    <input type="datetime-local" name="hari" class="form-input" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Tempat / Lokasi</label>
                <input type="text" name="tempat" class="form-input" placeholder="Contoh: Ruang Rapat Senat" required>
            </div>

            <div class="form-group">
                <label class="form-label">Divisi Penugasan</label>
                <select name="division_id" class="form-select" id="division-selector">
                    <option value="">-- Pilih Divisi (Opsional) --</option>
                    @foreach($divisions as $div)
                        <option value="{{ $div->id }}">{{ $div->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Status Pelaksanaan</label>
                <select name="status_pelaksanaan" class="form-select">
                    <option value="Direncanakan">Direncanakan (Scheduled)</option>
                    <option value="Berjalan">Berjalan (In Progress)</option>
                    <option value="Selesai">Selesai (Completed)</option>
                    <option value="Batal">Batal (Canceled)</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Pilih Auditor (Bisa banyak)</label>
                <div class="auditor-checkbox-list" id="auditor-checkbox-list">
                    @foreach($auditors as $auditor)
                        <label class="auditor-checkbox-item" data-division-id="{{ $auditor->division_id }}">
                            <input type="checkbox" name="auditor_ids[]" value="{{ $auditor->id }}">
                            <span>{{ $auditor->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Keterangan / Deskripsi</label>
                <textarea name="keterangan" class="form-input" rows="3" placeholder="Tambahkan deskripsi atau instruksi tambahan jika ada..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 12px;">Simpan Jadwal</button>
        </form>
    </div>

    <!-- Kalender Interaktif (Right side) -->
    <div class="card">
        <h3 class="card-title">Kalender Kegiatan Interaktif</h3>
        <div id="calendar" style="min-height: 600px;"></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize FullCalendar
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            locale: 'id',
            firstDay: 1,
            events: '/api/calendar', // Dinamis mengambil dari endpoint controller
            eventClick: function(info) {
                // Panggil fungsi global modal dari layout app
                openEventModal(info);
            }
        });
        calendar.render();

        // Logika Pemerataan Tugas: Filter auditor berdasarkan divisi yang dipilih secara dinamis
        const divisionSelector = document.getElementById('division-selector');
        const checkboxItems = document.querySelectorAll('.auditor-checkbox-item');

        divisionSelector.addEventListener('change', function() {
            const selectedDivId = this.value;
            checkboxItems.forEach(item => {
                const itemDivId = item.getAttribute('data-division-id');
                if (!selectedDivId) {
                    // Tampilkan semua auditor jika tidak ada divisi terpilih
                    item.style.display = 'flex';
                } else if (itemDivId === selectedDivId) {
                    // Tampilkan hanya auditor yang terdaftar di divisi yang sesuai
                    item.style.display = 'flex';
                    item.style.border = '1px solid var(--accent)';
                } else {
                    // Sembunyikan auditor dari divisi lain
                    item.style.display = 'none';
                    // Uncheck jika sempat tercentang agar integritas data terjaga
                    item.querySelector('input').checked = false;
                }
            });
        });
    });
</script>
@endsection
