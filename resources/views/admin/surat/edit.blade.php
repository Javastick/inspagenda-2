<x-layout.app>
    <div class="max-w-3xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost btn-sm btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-base-content">Edit Surat Undangan</h1>
                <p class="text-base-content/60 text-sm">Perbarui informasi jadwal pemeriksaan</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card bg-base-100 shadow-sm border border-base-200">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.surat.update', $schedule->id) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Pengirim -->
                        <div class="form-control md:col-span-2">
                            <label class="label" for="sender"><span class="label-text font-medium">Nama Instansi Pengirim <span class="text-error">*</span></span></label>
                            <input id="sender" type="text" name="sender" value="{{ old('sender', $schedule->sender) }}"
                                   class="input input-bordered w-full @error('sender') input-error @enderror" required>
                            @error('sender')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Kegiatan -->
                        <div class="form-control md:col-span-2">
                            <label class="label" for="kegiatan"><span class="label-text font-medium">Nama Kegiatan <span class="text-error">*</span></span></label>
                            <input id="kegiatan" type="text" name="kegiatan" value="{{ old('kegiatan', $schedule->kegiatan) }}"
                                   class="input input-bordered w-full @error('kegiatan') input-error @enderror" required>
                            @error('kegiatan')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Tgl Masuk -->
                        <div class="form-control">
                            <label class="label" for="masuk"><span class="label-text font-medium">Tanggal Surat Masuk <span class="text-error">*</span></span></label>
                            <input id="masuk" type="datetime-local" name="masuk" value="{{ old('masuk', $schedule->masuk?->format('Y-m-d\TH:i')) }}"
                                   class="input input-bordered w-full @error('masuk') input-error @enderror" required>
                            @error('masuk')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Tgl Kegiatan -->
                        <div class="form-control">
                            <label class="label" for="hari"><span class="label-text font-medium">Tanggal Pelaksanaan <span class="text-error">*</span></span></label>
                            <input id="hari" type="datetime-local" name="hari" value="{{ old('hari', $schedule->hari?->format('Y-m-d\TH:i')) }}"
                                   class="input input-bordered w-full @error('hari') input-error @enderror" required>
                            @error('hari')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Tempat -->
                        <div class="form-control">
                            <label class="label" for="tempat"><span class="label-text font-medium">Lokasi <span class="text-error">*</span></span></label>
                            <input id="tempat" type="text" name="tempat" value="{{ old('tempat', $schedule->tempat) }}"
                                   class="input input-bordered w-full @error('tempat') input-error @enderror" required>
                            @error('tempat')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Division -->
                        <div class="form-control">
                            <label class="label" for="division_id"><span class="label-text font-medium">Divisi Penugasan</span></label>
                            <select id="division_id" name="division_id" class="select select-bordered w-full" onchange="updateAuditors(this.value)">
                                <option value="">-- Pilih Divisi (Opsional) --</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}" {{ old('division_id', $schedule->division_id) == $division->id ? 'selected' : '' }}>
                                        {{ $division->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Auditors -->
                        <div class="form-control md:col-span-2">
                            <label class="label"><span class="label-text font-medium">Auditor yang Bertugas</span></label>
                            <div id="auditor-list" class="grid grid-cols-2 sm:grid-cols-3 gap-2 p-3 bg-base-200 rounded-lg min-h-[60px]">
                                <p class="text-sm text-base-content/50 col-span-full text-center py-2">Memuat daftar auditor...</p>
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div class="form-control md:col-span-2">
                            <label class="label" for="keterangan"><span class="label-text font-medium">Keterangan Tambahan</span></label>
                            <textarea id="keterangan" name="keterangan" rows="3"
                                      class="textarea textarea-bordered w-full @error('keterangan') textarea-error @enderror">{{ old('keterangan', $schedule->keterangan) }}</textarea>
                            @error('keterangan')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="flex gap-3 justify-end pt-2">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            Perbarui Surat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#masuk", {
                enableTime: true,
                altInput: true,
                altFormat: "d/m/Y H:i",
                dateFormat: "Y-m-d H:i:s",
                time_24hr: true,
                locale: "id"
            });
            flatpickr("#hari", {
                enableTime: true,
                altInput: true,
                altFormat: "d/m/Y H:i",
                dateFormat: "Y-m-d H:i:s",
                time_24hr: true,
                locale: "id"
            });
        });

        const divisionsData = @json($divisions->map(fn($d) => ['id' => $d->id, 'auditors' => $d->auditors->map(fn($a) => ['id' => $a->id, 'name' => $a->name])]));
        const currentAuditorIds = @json($schedule->auditors->pluck('id'));

        function updateAuditors(divisionId) {
            const container = document.getElementById('auditor-list');
            const division = divisionsData.find(d => d.id == divisionId);

            if (!division || division.auditors.length === 0) {
                container.innerHTML = '<p class="text-sm text-base-content/50 col-span-full text-center py-2">Tidak ada auditor pada divisi ini.</p>';
                return;
            }

            container.innerHTML = division.auditors.map(a => `
                <label class="flex items-center gap-2 cursor-pointer p-2 bg-base-100 rounded-lg hover:bg-primary/10 transition-colors">
                    <input type="checkbox" name="auditor_ids[]" value="${a.id}" class="checkbox checkbox-primary checkbox-sm"
                           ${currentAuditorIds.includes(a.id) ? 'checked' : ''}>
                    <span class="text-sm">${a.name}</span>
                </label>
            `).join('');
        }

        // Auto-load on page load
        const divisionSelect = document.getElementById('division_id');
        if (divisionSelect.value) updateAuditors(divisionSelect.value);
    </script>
    @endpush
</x-layout.app>
