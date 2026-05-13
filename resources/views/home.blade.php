<x-layout.app title="Kalender Utama - Inspagenda-2">
    <div class="p-4 md:p-8 max-w-7xl mx-auto w-full">
        <div class="mb-8">
            <h1 class="text-3xl font-display font-bold text-base-content">Dashboard Kalender</h1>
            <p class="text-base-content/70">Ringkasan seluruh agenda audit institusi.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Calendar Widget (Takes up 2 columns on large screens) -->
            <div class="lg:col-span-2">
                <x-calendar-widget id="main-calendar" eventsUrl="/api/calendar" />
            </div>

            <!-- Schedule Lists (Right column) -->
            <div class="flex flex-col gap-8">
                <x-schedule-list 
                    title="Jadwal Hari Ini" 
                    :schedules="$todaySchedules ?? collect([])" 
                />

                <x-schedule-list 
                    title="Jadwal 2 Hari Kedepan" 
                    :schedules="$upcomingSchedules ?? collect([])" 
                />
            </div>
        </div>
    </div>
</x-layout.app>
