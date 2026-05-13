<x-layout.app title="Selamat Datang di Inspagenda-2">
    <div class="hero min-h-[80vh] bg-base-200">
        <div class="hero-content text-center">
            <div class="max-w-2xl">
                <div class="mb-8 flex justify-center">
                    <div class="bg-primary text-primary-content w-20 h-20 rounded-2xl flex items-center justify-center font-display font-bold text-5xl shadow-lg">
                        I
                    </div>
                </div>
                
                <h1 class="text-5xl font-display font-bold text-base-content mb-6">
                    Sistem Penjadwalan Audit<br/>
                    <span class="text-primary">Inspagenda-2</span>
                </h1>
                
                <p class="py-6 text-lg text-base-content/80 mb-8">
                    Kelola jadwal audit dengan mudah, pantau beban kerja auditor secara transparan, dan optimalkan distribusi penugasan antar divisi dalam satu platform terpadu.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/home" class="btn btn-primary btn-lg px-8">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        Kalender Utama
                    </a>
                    
                    <a href="/admin/dashboard" class="btn btn-outline btn-lg px-8">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                        </svg>
                        Dashboard Admin
                    </a>
                    
                    <div class="dropdown dropdown-hover dropdown-bottom dropdown-end sm:dropdown-end">
                        <label tabindex="0" class="btn btn-outline btn-lg px-8 m-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                            Portal Divisi
                        </label>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                            @foreach(\App\Models\Division::all() as $div)
                                <li><a href="/portal/division/{{ $div->id }}">{{ $div->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
