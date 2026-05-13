@props(['divisions' => collect([]), 'currentDivisionId' => null])

<div class="card bg-base-100 shadow-xl border border-base-200 w-full mb-6">
    <div class="card-body p-4 md:p-6">
        <h3 class="card-title text-lg font-display text-base-content mb-4 border-b border-base-200 pb-2">
            Pilih Divisi
        </h3>
        
        <ul class="menu bg-base-200 rounded-box">
            @foreach($divisions as $div)
                <li>
                    <a href="/portal/division/{{ $div->id }}" class="{{ $currentDivisionId == $div->id ? 'active bg-primary text-primary-content font-bold' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                        {{ $div->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
