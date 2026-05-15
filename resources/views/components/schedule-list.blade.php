@props(['schedules'])

@php
    $todaySchedules = $schedules->filter(function ($s) {
        return $s->hari && $s->hari->isToday();
    });
    
    $upcomingSchedules = $schedules->filter(function ($s) {
        return $s->hari && $s->hari->isFuture() && !$s->hari->isToday();
    });
@endphp

<div class="space-y-6">
    <!-- Today's Schedules -->
    <div class="card bg-base-100 shadow-sm border border-base-200">
        <div class="card-body p-4 md:p-6">
            <h2 class="card-title text-success mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Jadwal Hari Ini
            </h2>
            
            @if($todaySchedules->isEmpty())
                <div class="alert alert-ghost bg-base-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-info shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Tidak ada jadwal pemeriksaan hari ini.</span>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>Kegiatan</th>
                                <th>Lokasi</th>
                                <th>Auditor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todaySchedules as $schedule)
                                <tr>
                                    <td class="font-medium">{{ $schedule->hari->format('H:i') }}</td>
                                    <td>{{ $schedule->kegiatan }}</td>
                                    <td>{{ $schedule->tempat }}</td>
                                    <td>
                                        @foreach($schedule->auditors as $auditor)
                                            <span class="badge badge-ghost badge-sm">{{ $auditor->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Upcoming Schedules -->
    <div class="card bg-base-100 shadow-sm border border-base-200">
        <div class="card-body p-4 md:p-6">
            <h2 class="card-title text-warning mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                Jadwal Mendatang
            </h2>

            @if($upcomingSchedules->isEmpty())
                <div class="alert alert-ghost bg-base-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-info shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Tidak ada jadwal di masa mendatang.</span>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kegiatan</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($upcomingSchedules->take(5) as $schedule)
                                <tr>
                                    <td class="font-medium whitespace-nowrap">{{ $schedule->hari->format('d M Y') }}</td>
                                    <td>{{ $schedule->kegiatan }}</td>
                                    <td>{{ $schedule->tempat }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
