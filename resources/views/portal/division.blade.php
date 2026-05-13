<x-layout.app title="Portal Divisi: {{ $division->name }}">
    <div class="p-4 md:p-8 max-w-7xl mx-auto w-full">
        <!-- Welcome banner -->
        <div class="hero rounded-2xl bg-gradient-to-br from-primary to-accent text-primary-content mb-8 shadow-xl">
            <div class="hero-content text-center py-10 md:py-16">
                <div class="max-w-2xl">
                    <h1 class="text-4xl md:text-5xl font-display font-bold mb-4">Portal {{ $division->name }}</h1>
                    <p class="text-lg opacity-90">
                        Pantau distribusi penugasan auditor dan kelola agenda audit spesifik untuk divisi Anda dengan mudah.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Sidebar Navigation -->
            <div class="lg:w-1/4 flex-shrink-0">
                <x-division-sidebar 
                    :divisions="\App\Models\Division::all()" 
                    :currentDivisionId="$division->id" 
                />
            </div>

            <!-- Main Portal Content -->
            <div class="lg:w-3/4 flex flex-col gap-8">
                <!-- Auditor Workload Equalization Stats -->
                <div>
                    <h2 class="text-2xl font-display font-bold text-base-content mb-2 flex items-center gap-2">
                        Beban Kerja Auditor
                        <span class="badge badge-primary badge-sm font-bold">{{ $currentMonthName ?? \Carbon\Carbon::now()->isoFormat('MMMM YYYY') }}</span>
                    </h2>
                    <p class="text-base-content/70 mb-4 text-sm">Distribusi penugasan bulanan untuk pemerataan beban kerja (*Workload Equalization*).</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                        @foreach($division->auditors->sortBy('invite_mails_count') as $auditor)
                            @php
                                $maxCap = max(10, $division->auditors->max('invite_mails_count'));
                            @endphp
                            <x-auditor-stats :auditor="$auditor" :maxCap="$maxCap" />
                        @endforeach
                    </div>
                </div>

                <div class="divider"></div>

                <!-- Division Specific Calendar -->
                <div>
                    <h2 class="text-2xl font-display font-bold text-base-content mb-4">Kalender Kegiatan Divisi</h2>
                    <x-calendar-widget 
                        id="division-calendar-{{ $division->id }}" 
                        eventsUrl="/api/calendar?division_id={{ $division->id }}" 
                    />
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
