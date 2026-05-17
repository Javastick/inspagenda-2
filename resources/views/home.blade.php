<x-layout.app>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-base-content">Kalender Jadwal Pemeriksaan</h1>
                <p class="text-base-content/60 text-sm mt-1">Agenda Inspektorat secara keseluruhan</p>
            </div>
            <div class="flex items-center gap-3">
                <!-- Legend -->
                <div class="flex items-center gap-1.5">
                    <span class="w-3 h-3 rounded-full bg-neutral-400 inline-block"></span>
                    <span class="text-xs text-base-content/60">Terlewat</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="w-3 h-3 rounded-full bg-success inline-block"></span>
                    <span class="text-xs text-base-content/60">Hari Ini</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="w-3 h-3 rounded-full bg-warning inline-block"></span>
                    <span class="text-xs text-base-content/60">Mendatang</span>
                </div>
            </div>
        </div>

        <!-- Calendar Widget -->
        <x-calendar-widget />

        <!-- Schedule List (Today & Next 2 Days) -->
        @php
            $schedules = \App\Models\InviteMail::with(['division','auditors'])
                ->whereNotNull('hari')
                ->where('hari', '>=', now()->startOfDay())
                ->where('hari', '<=', now()->addDays(2)->endOfDay())
                ->orderBy('hari')
                ->get();
        @endphp
        <x-schedule-list :schedules="$schedules" />
    </div>
</x-layout.app>
