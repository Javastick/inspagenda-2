<x-layout.app>
    <div class="max-w-3xl mx-auto space-y-6">
        <!-- Back -->
        <div class="flex items-center gap-3">
            <a href="javascript:history.back()" class="btn btn-ghost btn-sm btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-base-content">Detail Jadwal</h1>
                <p class="text-base-content/60 text-sm">Informasi lengkap kegiatan</p>
            </div>
        </div>

        <!-- Status & Title Card -->
        <div class="card bg-base-100 shadow-sm border border-base-200">
            <div class="card-body">
                @php
                    $now = \Carbon\Carbon::today();
                    $eventDate = $schedule->hari ? $schedule->hari->startOfDay() : null;
                    $badge = 'badge-ghost'; $badgeText = 'Tidak Diketahui';
                    if ($eventDate) {
                        if ($eventDate->lt($now)) { $badge = 'badge-ghost'; $badgeText = 'Terlewat'; }
                        elseif ($eventDate->eq($now)) { $badge = 'badge-success'; $badgeText = 'Hari Ini'; }
                        else { $badge = 'badge-warning'; $badgeText = 'Mendatang'; }
                    }
                @endphp
                <div class="flex flex-wrap items-start justify-between gap-3">
                    <h2 class="text-xl font-bold text-base-content leading-snug">{{ $schedule->kegiatan }}</h2>
                    <span class="badge {{ $badge }} badge-lg">{{ $badgeText }}</span>
                </div>

                <div class="divider my-3"></div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Pengirim -->
                    <div class="flex gap-3 items-start">
                        <div class="p-2 bg-base-200 rounded-lg flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                        <div>
                            <p class="text-xs text-base-content/50 mb-0.5">Instansi Pengirim</p>
                            <p class="font-medium text-sm">{{ $schedule->sender }}</p>
                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div class="flex gap-3 items-start">
                        <div class="p-2 bg-base-200 rounded-lg flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <div>
                            <p class="text-xs text-base-content/50 mb-0.5">Lokasi</p>
                            <p class="font-medium text-sm">{{ $schedule->tempat }}</p>
                        </div>
                    </div>

                    <!-- Tanggal Masuk -->
                    <div class="flex gap-3 items-start">
                        <div class="p-2 bg-base-200 rounded-lg flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <div>
                            <p class="text-xs text-base-content/50 mb-0.5">Surat Masuk</p>
                            <p class="font-medium text-sm">{{ $schedule->masuk?->translatedFormat('d F Y') ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- Tanggal Kegiatan -->
                    <div class="flex gap-3 items-start">
                        <div class="p-2 bg-base-200 rounded-lg flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div>
                            <p class="text-xs text-base-content/50 mb-0.5">Tanggal Pelaksanaan</p>
                            <p class="font-semibold text-sm">{{ $schedule->hari?->translatedFormat('d F Y, H:i') ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- Divisi -->
                    <div class="flex gap-3 items-start">
                        <div class="p-2 bg-base-200 rounded-lg flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        </div>
                        <div>
                            <p class="text-xs text-base-content/50 mb-0.5">Divisi Irban</p>
                            <p class="font-medium text-sm">{{ $schedule->division?->name ?? 'Belum Ditentukan' }}</p>
                        </div>
                    </div>

                    <!-- Status Jadwal (Dinamis dari Carbon) -->
                    <div class="flex gap-3 items-start">
                        <div class="p-2 bg-base-200 rounded-lg flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                        </div>
                        <div>
                            <p class="text-xs text-base-content/50 mb-0.5">Status Jadwal</p>
                            <div class="badge {{ $badge }} badge-sm mt-1">{{ $badgeText }}</div>
                        </div>
                    </div>
                </div>

                <!-- Auditors -->
                @if($schedule->auditors->isNotEmpty())
                    <div class="divider">Auditor Bertugas</div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($schedule->auditors as $auditor)
                            <div class="badge badge-outline badge-primary gap-1 py-3 px-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                {{ $auditor->name }}
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Keterangan -->
                @if($schedule->keterangan)
                    <div class="divider">Keterangan</div>
                    <div class="bg-base-200 rounded-xl p-4 text-sm text-base-content/80 leading-relaxed whitespace-pre-wrap">{{ $schedule->keterangan }}</div>
                @endif
            </div>
        </div>
    </div>
</x-layout.app>
