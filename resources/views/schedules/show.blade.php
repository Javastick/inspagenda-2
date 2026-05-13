@extends('layouts.app')

@section('title', 'Detail Jadwal: ' . $schedule->kegiatan)
@section('header_title', 'Detail Jadwal')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <a href="{{ route('schedules.index') }}" class="btn btn-secondary" style="margin-bottom: 24px;">
        <svg style="width: 16px; height: 16px; margin-right: 4px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
        </svg>
        Kembali ke Kalender
    </a>

    <div class="card" style="padding: 40px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px; border-bottom: 1px solid var(--border-color); padding-bottom: 20px;">
            <div>
                <span class="badge {{ strtolower($schedule->status_pelaksanaan) == 'selesai' ? 'badge-success' : (strtolower($schedule->status_pelaksanaan) == 'batal' ? 'badge-danger' : 'badge-warning') }}" style="margin-bottom: 8px;">
                    {{ $schedule->status_pelaksanaan ?? 'Pending' }}
                </span>
                <h2 style="font-size: 28px; font-weight: 800; color: var(--text-main);">{{ $schedule->kegiatan }}</h2>
            </div>
            <div style="font-size: 40px; color: var(--accent); opacity: 0.2;">
                <svg style="width: 64px; height: 64px;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-2.25-4.062-2.25-4.062 0v2.625c0 .621.504 1.125 1.125 1.125z"></path>
                </svg>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
            <div class="modal-info-item">
                <span class="modal-info-label">Waktu Pelaksanaan (Hari & Jam)</span>
                <span class="modal-info-value" style="font-size: 16px; font-weight: 600;">
                    {{ $schedule->hari ? $schedule->hari->isoFormat('dddd, D MMMM YYYY - HH:mm') . ' WIB' : '-' }}
                </span>
            </div>

            <div class="modal-info-item">
                <span class="modal-info-label">Tempat / Ruangan</span>
                <span class="modal-info-value" style="font-size: 16px; font-weight: 600;">{{ $schedule->tempat }}</span>
            </div>

            <div class="modal-info-item">
                <span class="modal-info-label">Tanggal Masuk Surat</span>
                <span class="modal-info-value">{{ $schedule->masuk ? $schedule->masuk->isoFormat('D MMMM YYYY') : '-' }}</span>
            </div>

            <div class="modal-info-item">
                <span class="modal-info-label">Pengirim Undangan (Sender)</span>
                <span class="modal-info-value">{{ $schedule->sender }}</span>
            </div>

            <div class="modal-info-item" style="grid-column: span 2;">
                <span class="modal-info-label">Divisi Penugasan</span>
                <span class="modal-info-value" style="font-weight: 600; color: var(--accent);">
                    {{ $schedule->division ? $schedule->division->name : 'Umum / Semua Divisi' }}
                </span>
            </div>

            <div class="modal-info-item" style="grid-column: span 2;">
                <span class="modal-info-label">Auditor Terpilih</span>
                <span class="modal-info-value" style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 6px;">
                    @if($schedule->auditors->isEmpty())
                        <span style="color: var(--text-muted); font-style: italic;">Belum ada auditor ditugaskan.</span>
                    @else
                        @foreach($schedule->auditors as $auditor)
                            <span style="background-color: var(--accent-light); color: var(--accent); padding: 6px 12px; border-radius: 8px; font-weight: 600; font-size: 13px;">
                                {{ $auditor->name }}
                            </span>
                        @endforeach
                    @endif
                </span>
            </div>

            <div class="modal-info-item" style="grid-column: span 2; border-top: 1px solid var(--border-color); padding-top: 20px;">
                <span class="modal-info-label">Keterangan Tambahan</span>
                <span class="modal-info-value" style="color: var(--text-muted); font-style: italic; line-height: 1.6; margin-top: 6px; display: block;">
                    {{ $schedule->keterangan ?: 'Tidak ada keterangan tambahan yang diunggah.' }}
                </span>
            </div>
        </div>
    </div>
</div>
@endsection
