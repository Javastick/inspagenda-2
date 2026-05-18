<x-layout.app>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-base-content">Kalender Jadwal</h1>
                <p class="text-base-content/60 text-sm mt-1">Agenda Inspektorat</p>
            </div>
            <!-- <div class="flex items-center gap-3">
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
            </div> -->
        </div>
        @php
            $schedules = \App\Models\InviteMail::with(['division','auditors'])
                ->whereNull('division_id')
                ->whereNotNull('hari')
                ->where('hari', '>=', now()->startOfDay())
                ->where('hari', '<=', now()->addDays(2)->endOfDay())
                ->orderBy('hari')
                ->get();
        @endphp
        <x-schedule-list :schedules="$schedules" />
        <!-- Calendar Widget — home mode: only shows schedules without division (division_id IS NULL) -->
        <x-calendar-widget mode="home" />

        <!-- Schedule List (Today & Next 2 Days) — only schedules without division -->

        
    </div>
</x-layout.app>
