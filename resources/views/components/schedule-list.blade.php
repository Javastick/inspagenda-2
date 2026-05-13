@props(['title' => 'Daftar Jadwal', 'schedules' => collect([])])

<div class="card bg-base-100 shadow-xl border border-base-200">
    <div class="card-body p-4 md:p-6">
        <h3 class="card-title text-lg font-display text-base-content mb-4 border-b border-base-200 pb-2">
            {{ $title }}
            <span class="badge badge-primary">{{ $schedules->count() }}</span>
        </h3>

        @if($schedules->isEmpty())
            <div class="text-center py-8 text-base-content/50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto mb-3 opacity-30">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                </svg>
                <p class="font-medium text-sm">Tidak ada jadwal.</p>
            </div>
        @else
            <ul class="flex flex-col gap-3 max-h-[400px] overflow-y-auto pr-2">
                @foreach($schedules as $schedule)
                    @php
                        $statusClass = 'badge-warning';
                        if (strtolower($schedule->status_pelaksanaan) == 'selesai') $statusClass = 'badge-success';
                        if (strtolower($schedule->status_pelaksanaan) == 'batal') $statusClass = 'badge-error';
                    @endphp
                    <li class="bg-base-200 rounded-lg p-4 border-l-4 border-l-primary hover:bg-base-300 transition-colors">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="font-bold text-sm text-base-content">{{ $schedule->kegiatan }}</h4>
                            <span class="badge {{ $statusClass }} badge-sm text-[10px] font-bold">{{ $schedule->status_pelaksanaan ?? 'Pending' }}</span>
                        </div>
                        <div class="text-xs text-base-content/70 flex flex-col gap-1">
                            <div class="flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $schedule->hari ? $schedule->hari->isoFormat('dddd, D MMM YYYY - HH:mm') . ' WIB' : '-' }}
                            </div>
                            <div class="flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1115 0z" />
                                </svg>
                                {{ $schedule->tempat }}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
