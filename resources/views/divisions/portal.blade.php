<x-layout.app>
    <div class="space-y-6">
        <!-- Header section for the main area -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-base-100 p-4 rounded-xl shadow-sm border border-base-200">
            <div>
                <h1 class="text-2xl font-bold text-base-content">Portal Divisi: {{ $division->name }}</h1>
                <p class="text-base-content/70 text-sm mt-1">Jadwal Pemeriksaan & Penugasan Auditor</p>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            <!-- Left Column: Schedule List -->
            <div class="lg:col-span-5 space-y-6">
                <x-schedule-list :schedules="$schedules" />
            </div>
            
            <!-- Right Column: Calendar Widget -->
            <div class="lg:col-span-7">
                <x-calendar-widget mode="division" :divisionId="$division->id" />
            </div>
        </div>

        <!-- Assignment Statistics (bottom position) -->
        <x-auditor-stats :auditors="$division->auditors" />
    </div>
</x-layout.app>
