<x-layout.app title="Dashboard Admin - Inspagenda-2">
    <div class="p-4 md:p-8 max-w-7xl mx-auto w-full">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-display font-bold text-base-content">Manajemen Jadwal</h1>
                <p class="text-base-content/70">Kelola dan jadwalkan kegiatan audit institusi.</p>
            </div>
            <button class="btn btn-primary shadow-lg shadow-primary/30" onclick="add_schedule_modal.showModal()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Jadwal Baru
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-lg mb-6 text-success-content font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="card bg-base-100 shadow-xl border border-base-200">
            <div class="card-body p-0 overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead class="bg-base-200 text-base-content font-bold">
                        <tr>
                            <th class="rounded-tl-2xl">Kegiatan</th>
                            <th>Waktu Pelaksanaan</th>
                            <th>Tempat</th>
                            <th>Divisi</th>
                            <th>Status</th>
                            <th class="text-center rounded-tr-2xl">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schedules ?? [] as $schedule)
                            @php
                                $statusClass = 'badge-warning';
                                if (strtolower($schedule->status_pelaksanaan) == 'selesai') $statusClass = 'badge-success';
                                if (strtolower($schedule->status_pelaksanaan) == 'batal') $statusClass = 'badge-error';
                            @endphp
                            <tr class="hover">
                                <td class="font-bold">{{ $schedule->kegiatan }}</td>
                                <td>{{ $schedule->hari ? $schedule->hari->isoFormat('D MMM YYYY, HH:mm') : '-' }}</td>
                                <td>{{ $schedule->tempat }}</td>
                                <td>{{ $schedule->division ? $schedule->division->name : 'Umum' }}</td>
                                <td><span class="badge {{ $statusClass }} badge-sm font-bold">{{ $schedule->status_pelaksanaan }}</span></td>
                                <td class="text-center">
                                    <div class="join">
                                        <a href="/schedules/{{ $schedule->id }}" class="btn btn-sm btn-ghost join-item text-info tooltip" data-tip="Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                        </a>
                                        <button class="btn btn-sm btn-ghost join-item text-error tooltip" data-tip="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-12 text-base-content/50">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto mb-4 opacity-30"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                                    <p class="font-medium text-lg">Belum ada data jadwal.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah Jadwal -->
    <dialog id="add_schedule_modal" class="modal">
        <div class="modal-box w-11/12 max-w-4xl border-t-4 border-primary">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-2xl font-display text-primary mb-6">Tambah Jadwal Baru</h3>
            
            <form action="{{ route('schedules.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="form-control w-full">
                        <label class="label"><span class="label-text font-bold">Nama Kegiatan</span></label>
                        <input type="text" name="kegiatan" class="input input-bordered w-full focus:input-primary" required />
                    </div>
                    
                    <div class="form-control w-full">
                        <label class="label"><span class="label-text font-bold">Pengirim Undangan</span></label>
                        <input type="text" name="sender" class="input input-bordered w-full focus:input-primary" required />
                    </div>

                    <div class="form-control w-full">
                        <label class="label"><span class="label-text font-bold">Tanggal Surat</span></label>
                        <input type="date" name="masuk" class="input input-bordered w-full focus:input-primary" required />
                    </div>

                    <div class="form-control w-full">
                        <label class="label"><span class="label-text font-bold">Waktu Pelaksanaan</span></label>
                        <input type="datetime-local" name="hari" class="input input-bordered w-full focus:input-primary" required />
                    </div>

                    <div class="form-control w-full md:col-span-2">
                        <label class="label"><span class="label-text font-bold">Tempat Pelaksanaan</span></label>
                        <input type="text" name="tempat" class="input input-bordered w-full focus:input-primary" required />
                    </div>

                    <div class="form-control w-full">
                        <label class="label"><span class="label-text font-bold">Divisi Penugasan</span></label>
                        <select name="division_id" id="division-selector" class="select select-bordered w-full focus:select-primary">
                            <option value="">-- Semua Divisi --</option>
                            @foreach(\App\Models\Division::all() as $div)
                                <option value="{{ $div->id }}">{{ $div->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-control w-full">
                        <label class="label"><span class="label-text font-bold">Status Pelaksanaan</span></label>
                        <select name="status_pelaksanaan" class="select select-bordered w-full focus:select-primary">
                            <option value="Direncanakan">Direncanakan</option>
                            <option value="Berjalan">Berjalan</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Batal">Batal</option>
                        </select>
                    </div>

                    <div class="form-control w-full md:col-span-2">
                        <label class="label"><span class="label-text font-bold">Pilih Auditor</span></label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 bg-base-200 p-4 rounded-xl max-h-48 overflow-y-auto border border-base-300">
                            @foreach(\App\Models\Auditor::all() as $auditor)
                                <label class="label cursor-pointer justify-start gap-3 bg-base-100 p-2 rounded-lg border border-transparent hover:border-primary auditor-checkbox-item" data-division-id="{{ $auditor->division_id }}">
                                    <input type="checkbox" name="auditor_ids[]" value="{{ $auditor->id }}" class="checkbox checkbox-primary checkbox-sm" />
                                    <span class="label-text">{{ $auditor->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-control w-full md:col-span-2">
                        <label class="label"><span class="label-text font-bold">Keterangan Tambahan</span></label>
                        <textarea name="keterangan" class="textarea textarea-bordered focus:textarea-primary h-24"></textarea>
                    </div>
                </div>

                <div class="modal-action">
                    <button type="button" class="btn btn-ghost" onclick="add_schedule_modal.close()">Batal</button>
                    <button type="submit" class="btn btn-primary px-8">Simpan Jadwal</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <x-slot:scripts>
        <script>
            // Workload equalization logic: filter auditors by selected division
            document.addEventListener('DOMContentLoaded', function() {
                const divisionSelector = document.getElementById('division-selector');
                const checkboxItems = document.querySelectorAll('.auditor-checkbox-item');

                divisionSelector.addEventListener('change', function() {
                    const selectedDivId = this.value;
                    checkboxItems.forEach(item => {
                        const itemDivId = item.getAttribute('data-division-id');
                        if (!selectedDivId) {
                            item.style.display = 'flex';
                        } else if (itemDivId === selectedDivId) {
                            item.style.display = 'flex';
                        } else {
                            item.style.display = 'none';
                            item.querySelector('input').checked = false;
                        }
                    });
                });
            });
        </script>
    </x-slot:scripts>
</x-layout.app>
