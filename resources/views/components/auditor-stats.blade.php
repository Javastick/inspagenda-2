@props(['auditors'])

@php
    $sortedAuditors = $auditors->sortBy('invite_mails_count');
@endphp

<div class="card bg-base-100 shadow-sm border border-base-200">
    <div class="card-body p-4 md:p-6">
        <h2 class="card-title text-base mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
            Statistik Penugasan (Bulan Ini)
        </h2>

        @if($sortedAuditors->isEmpty())
            <p class="text-sm text-base-content/70 italic text-center py-4">Belum ada auditor terdaftar.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($sortedAuditors as $auditor)
                    <div class="flex justify-between items-center p-3 bg-base-200/50 hover:bg-primary/5 rounded-xl border border-base-200 transition-colors">
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('auditor.profile', $auditor->id) }}" class="text-sm font-semibold text-base-content hover:text-primary transition-colors block truncate">
                                {{ $auditor->name }}
                            </a>
                            <span class="text-xs text-base-content/60 block mt-0.5">
                                ditugaskan: <span class="font-medium text-base-content">{{ $auditor->invite_mails_count }} kali</span>
                            </span>
                        </div>
                        <span class="badge {{ $auditor->invite_mails_count > 0 ? 'badge-success text-success-content' : 'badge-warning text-warning-content' }} badge-md font-semibold ml-2 shrink-0">
                            {{ $auditor->invite_mails_count }} Tugas
                        </span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
