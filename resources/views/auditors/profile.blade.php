<x-layout.app>
    <div class="space-y-6">
        <!-- Back Button -->
        <div>
            <button onclick="history.back()" class="btn btn-ghost btn-sm mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali
            </button>
        </div>

        <!-- Auditor Header -->
        <div class="card bg-base-100 shadow-sm border border-base-200">
            <div class="card-body p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-base-content">{{ $auditor->name }}</h1>
                    <div class="flex items-center gap-2 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="text-base-content/70 font-medium">{{ $auditor->division ? $auditor->division->name : 'Tanpa Divisi' }}</span>
                    </div>
                </div>
                <div class="stat bg-base-200/50 rounded-xl w-auto shrink-0 border border-base-200 p-4">
                    <div class="stat-title text-sm">Total Penugasan</div>
                    <div class="stat-value text-primary text-2xl">{{ $auditor->invite_mails_count ?? $auditor->inviteMails->count() }}</div>
                </div>
            </div>
        </div>

        <!-- Assignment History -->
        <div>
            <h2 class="text-xl font-bold text-base-content mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Penugasan
            </h2>

            @if($groupedMails->isEmpty())
                <div class="card bg-base-100 border border-base-200 shadow-sm">
                    <div class="card-body text-center py-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-base-content/30 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="text-base-content/60">Belum ada riwayat penugasan untuk auditor ini.</p>
                    </div>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($groupedMails as $monthYear => $mails)
                        <div class="card bg-base-100 shadow-sm border border-base-200 overflow-hidden">
                            <!-- Group Header -->
                            <div class="bg-base-200/50 px-4 py-3 border-b border-base-200">
                                <h3 class="font-bold text-base-content">{{ $monthYear }}</h3>
                            </div>
                            
                            <!-- Group Content -->
                            <div class="overflow-x-auto">
                                <table class="table table-zebra w-full">
                                    <thead>
                                        <tr>
                                            <th class="bg-transparent text-xs w-32">Tanggal</th>
                                            <th class="bg-transparent text-xs">Kegiatan</th>
                                            <th class="bg-transparent text-xs">Tempat</th>
                                            <th class="bg-transparent text-xs w-16 text-center">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mails as $mail)
                                            <tr class="hover">
                                                <td class="text-sm font-medium whitespace-nowrap">
                                                    @php
                                                        $statusBadge = '';
                                                        $statusClass = '';
                                                        if ($mail->hari) {
                                                            $mailDate = \Carbon\Carbon::parse($mail->hari)->startOfDay();
                                                            if ($mailDate->isPast() && !$mailDate->isToday()) {
                                                                $statusBadge = 'Terlewat';
                                                                $statusClass = 'badge-neutral';
                                                            } elseif ($mailDate->isToday()) {
                                                                $statusBadge = 'Hari Ini';
                                                                $statusClass = 'badge-success';
                                                            } else {
                                                                $statusBadge = 'Mendatang';
                                                                $statusClass = 'badge-warning';
                                                            }
                                                        }
                                                    @endphp
                                                    <div class="flex flex-col gap-1 items-start">
                                                        <span>{{ $mail->hari ? $mail->hari->format('d/m/Y') : '-' }}</span>
                                                        @if($statusBadge)
                                                            <span class="badge badge-sm {{ $statusClass }} text-[10px] uppercase font-bold">{{ $statusBadge }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="text-sm">
                                                    <div class="font-medium line-clamp-2" title="{{ $mail->kegiatan }}">{{ $mail->kegiatan }}</div>
                                                    <div class="text-xs text-base-content/60 mt-0.5 max-w-sm truncate" title="{{ $mail->keterangan }}">{{ $mail->keterangan ?: '-' }}</div>
                                                </td>
                                                <td class="text-sm">
                                                    <div class="flex items-start gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-base-content/50 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                                        <span class="line-clamp-2" title="{{ $mail->tempat }}">{{ $mail->tempat }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('jadwal.show', $mail->id) }}" class="btn btn-ghost btn-xs btn-circle text-primary" title="Lihat Detail">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layout.app>
