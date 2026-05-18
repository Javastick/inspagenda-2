<x-layout.app>
    <div class="flex flex-col lg:flex-row gap-6">



        <!-- Main Content Area (Calendar & Schedules) -->
        <main class="flex-1 space-y-6 min-w-0">
            <!-- Header section for the main area -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-base-100 p-4 rounded-xl shadow-sm border border-base-200">
                <div>
                    <h1 class="text-2xl font-bold text-base-content">Portal Divisi: {{ $division->name }}</h1>
                    <p class="text-base-content/70 text-sm mt-1">Jadwal Pemeriksaan & Penugasan Auditor</p>
                </div>
            </div>

            <!-- Calendar Widget — division mode: only shows schedules for this division -->
            <x-calendar-widget mode="division" :divisionId="$division->id" />

            <!-- Schedule List Component -->
            <x-schedule-list :schedules="$schedules" />

            <!-- Left Sidebar (Division Info & Stats) -->
            <aside class="w-full lg:w-80 flex-shrink-0">
                <!-- <x-division-sidebar :division="$division" /> -->
                <x-auditor-stats :auditors="$division->auditors" />
            </aside>
        </main>

    </div>
</x-layout.app>
