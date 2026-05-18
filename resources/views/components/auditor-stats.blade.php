@props(['auditors'])

<div class="card bg-base-100 shadow-sm border border-base-200">
    <div class="card-body p-4 md:p-6">
        <h2 class="card-title text-base mb-4">Statistik Penugasan (Bulan Ini)</h2>

        <div class="space-y-4">
            @foreach($auditors as $auditor)
                <div>
                    <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium">
                                {{ $auditor->name }} <br>
                                <span class="text-base-content/60 font-normal">
                                    (ditugaskan) &mdash; {{ $auditor->invite_mails_count }} kali
                                </span>
                            </span>
                       
                        <span class="badge {{ $auditor->invite_mails_count > 0 ?  'badge-success' : 'badge-warning' }} badge-sm ml-2 shrink-0">
                            {{ $auditor->invite_mails_count }} Tugas
                        </span>
                    </div>
                </div>
            @endforeach

            @if($auditors->isEmpty())
                <p class="text-sm text-base-content/70 italic text-center">Belum ada auditor terdaftar.</p>
            @endif
        </div>
    </div>
</div>
