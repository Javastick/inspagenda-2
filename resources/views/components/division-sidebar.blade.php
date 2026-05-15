@props(['division'])

<div class="card bg-base-100 shadow-sm border border-base-200 mb-6">
    <div class="card-body p-4 md:p-6 text-center">
        <div class="avatar mx-auto mb-4">
            <div class="w-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                <img src="{{ asset('images/logo-inspagenda-512px.png') }}" alt="Irban Icon" />
            </div>
        </div>
        <h2 class="card-title justify-center text-xl font-bold">{{ $division->name }}</h2>
        <div class="badge badge-primary mx-auto mt-2">Inspektorat Pembantu</div>
        
        <div class="divider my-2"></div>
        
        <ul class="menu bg-base-100 w-full p-0 text-left">
            <li>
                <a class="active">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    Dashboard Portal
                </a>
            </li>
            <li>
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    Daftar Auditor
                </a>
            </li>
            <li>
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    Arsip Jadwal
                </a>
            </li>
        </ul>
    </div>
</div>
