<x-layout.app>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-base-content">Kalender Jadwal</h1>
                <p class="text-base-content/60 text-sm mt-1">Agenda Inspektorat</p>
            </div>
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <select id="division-filter" class="select select-bordered select-sm w-full sm:w-auto" onchange="filterDivision(this.value)">
                    <option value="">Semua Divisi</option>
                    @foreach(\App\Models\Division::all() as $div)
                        <option value="{{ $div->id }}" {{ request('division') == $div->id ? 'selected' : '' }}>{{ $div->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @php
            $query = \App\Models\InviteMail::with(['division','auditors'])
                ->whereNotNull('hari')
                ->where('hari', '>=', now()->startOfDay())
                ->orderBy('hari');
                
            if (request()->has('division') && request()->division != '') {
                $query->where('division_id', request()->division);
            }
            
            $schedules = $query->get();
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            <!-- Left Column: Schedule List -->
            <div class="lg:col-span-5 space-y-6">
                <x-schedule-list :schedules="$schedules" />
            </div>
            
            <!-- Right Column: Calendar Widget -->
            <div class="lg:col-span-7">
                <x-calendar-widget mode="home" />
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        function filterDivision(val) {
            let url = new URL(window.location.href);
            if(val) {
                url.searchParams.set('division', val);
            } else {
                url.searchParams.delete('division');
            }
            window.location.href = url.toString();
        }
    </script>
    @endpush
</x-layout.app>
