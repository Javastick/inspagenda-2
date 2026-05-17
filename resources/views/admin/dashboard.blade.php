<x-layout.app>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-base-content">Dashboard Admin</h1>
                <p class="text-base-content/60 text-sm mt-1">Manajemen Surat Undangan & Jadwal Pemeriksaan</p>
            </div>
            <a href="{{ route('admin.surat.create') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Tambah Surat
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="stat bg-base-100 rounded-xl shadow-sm border border-base-200">
                <div class="stat-figure text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
                <div class="stat-title text-sm">Total Surat</div>
                <div class="stat-value text-primary text-3xl">{{ $totalSchedules }}</div>
            </div>
            <div class="stat bg-base-100 rounded-xl shadow-sm border border-base-200">
                <div class="stat-figure text-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div class="stat-title text-sm">Jadwal Hari Ini</div>
                <div class="stat-value text-success text-3xl">{{ $todaySchedules }}</div>
            </div>
            <div class="stat bg-base-100 rounded-xl shadow-sm border border-base-200">
                <div class="stat-figure text-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
                <div class="stat-title text-sm">Jadwal Mendatang</div>
                <div class="stat-value text-warning text-3xl">{{ $futureSchedules }}</div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Arsip Surat Table -->
        <div class="card bg-base-100 shadow-sm border border-base-200">
            <div class="card-body p-0 md:p-2">
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead class="bg-base-200">
                            <tr>
                                <th class="text-xs">#</th>
                                <th class="text-xs">Status</th>
                                <th class="text-xs">Pengirim</th>
                                <th class="text-xs">Kegiatan</th>
                                <th class="text-xs">Lokasi</th>
                                <th class="text-xs">Tgl. Masuk</th>
                                <th class="text-xs">Tgl. Kegiatan</th>
                                <th class="text-xs">Divisi</th>
                                <th class="text-xs">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($schedules as $i => $schedule)
                                <tr class="hover">
                                    <td class="text-xs text-base-content/50">{{ $i + 1 }}</td>
                                    <td>
                                        @if($schedule->status_badge === 'past')
                                            <div class="badge badge-ghost badge-sm whitespace-nowrap">Terlewat</div>
                                        @elseif($schedule->status_badge === 'today')
                                            <div class="badge badge-success badge-sm whitespace-nowrap">Hari Ini</div>
                                        @elseif($schedule->status_badge === 'future')
                                            <div class="badge badge-warning badge-sm whitespace-nowrap">Mendatang</div>
                                        @else
                                            <div class="badge badge-ghost badge-sm">—</div>
                                        @endif
                                    </td>
                                    <td class="text-sm max-w-[150px] truncate" title="{{ $schedule->sender }}">{{ $schedule->sender }}</td>
                                    <td class="text-sm max-w-[180px] truncate" title="{{ $schedule->kegiatan }}">{{ $schedule->kegiatan }}</td>
                                    <td class="text-sm max-w-[120px] truncate" title="{{ $schedule->tempat }}">{{ $schedule->tempat }}</td>
                                    <td class="text-xs whitespace-nowrap">{{ $schedule->masuk ? $schedule->masuk->format('d/m/Y') : '-' }}</td>
                                    <td class="text-xs whitespace-nowrap">{{ $schedule->hari ? $schedule->hari->format('d/m/Y') : '-' }}</td>
                                    <td class="text-xs">
                                        @if($schedule->division)
                                            <div class="badge badge-outline badge-sm">{{ $schedule->division->name }}</div>
                                        @else
                                            <span class="text-base-content/40">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-1">
                                            <a href="{{ route('jadwal.show', $schedule->id) }}"
                                               class="btn btn-ghost btn-xs" title="Lihat">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                            </a>
                                            <a href="{{ route('admin.surat.edit', $schedule->id) }}"
                                               class="btn btn-ghost btn-xs text-info" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                            </a>
                                            <form method="POST" action="{{ route('admin.surat.destroy', $schedule->id) }}"
                                                  onsubmit="return confirm('Hapus surat ini?')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-ghost btn-xs text-error" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-10 text-base-content/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                        Belum ada surat undangan. <a href="{{ route('admin.surat.create') }}" class="link link-primary">Tambah sekarang</a>.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
