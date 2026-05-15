@props(['auditors'])

<div class="card bg-base-100 shadow-sm border border-base-200">
    <div class="card-body p-4 md:p-6">
        <h2 class="card-title text-base mb-4">Statistik Penugasan (Bulan Ini)</h2>
        
        <div class="space-y-4">
            @foreach($auditors as $auditor)
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm font-medium">{{ $auditor->name }}</span>
                        <span class="badge {{ $auditor->audit_count_this_month > 5 ? 'badge-error' : ($auditor->audit_count_this_month > 3 ? 'badge-warning' : 'badge-success') }}">
                            {{ $auditor->audit_count_this_month }} Tugas
                        </span>
                    </div>
                    <!-- Assuming max 10 tasks for the progress bar max -->
                    <progress class="progress {{ $auditor->audit_count_this_month > 5 ? 'progress-error' : ($auditor->audit_count_this_month > 3 ? 'progress-warning' : 'progress-success') }} w-full" value="{{ $auditor->audit_count_this_month }}" max="10"></progress>
                </div>
            @endforeach
            
            @if($auditors->isEmpty())
                <p class="text-sm text-base-content/70 italic text-center">Belum ada auditor terdaftar.</p>
            @endif
        </div>
    </div>
</div>
