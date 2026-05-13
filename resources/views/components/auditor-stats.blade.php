@props(['auditor', 'maxCap' => 10])

@php
    $percentage = min(100, ($auditor->invite_mails_count / $maxCap) * 100);
    $badgeColor = 'badge-primary';
    $progressColor = 'progress-primary';
    
    if ($auditor->invite_mails_count > 5) {
        $badgeColor = 'badge-warning';
        $progressColor = 'progress-warning';
    }
    if ($auditor->invite_mails_count > 8) {
        $badgeColor = 'badge-error';
        $progressColor = 'progress-error';
    }
@endphp

<div class="card bg-base-100 shadow-sm border border-base-200">
    <div class="card-body p-4">
        <div class="flex justify-between items-center mb-2">
            <div>
                <h4 class="font-bold text-base-content">{{ $auditor->name }}</h4>
                <div class="badge badge-sm {{ $auditor->status == 'aktif' ? 'badge-success' : 'badge-error' }} mt-1">
                    {{ ucfirst($auditor->status) }}
                </div>
            </div>
            <div class="badge {{ $badgeColor }} font-bold p-3">
                {{ $auditor->invite_mails_count }} Tugas
            </div>
        </div>
        
        <progress class="progress {{ $progressColor }} w-full mt-2" value="{{ $auditor->invite_mails_count }}" max="{{ $maxCap }}"></progress>
    </div>
</div>
