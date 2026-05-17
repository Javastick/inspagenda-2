<?php

namespace Database\Factories;

use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

class InviteMailFactory extends Factory
{
    public function definition(): array
    {
        $masuk = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $hari  = $this->faker->dateTimeBetween('-1 month', '+1 month');

        return [
            'sender'             => $this->faker->company() . ' ' . $this->faker->randomElement(['Kota', 'Kabupaten', 'Provinsi']),
            'masuk'              => $masuk,
            'hari'               => $hari,
            'kegiatan'           => $this->faker->randomElement([
                'Pemeriksaan Keuangan', 'Audit Operasional', 'Reviu Laporan Keuangan',
                'Evaluasi Kinerja', 'Monitoring Program', 'Pemeriksaan Belanja Modal',
                'Audit Pengadaan Barang', 'Tindak Lanjut Temuan', 'Reviu Anggaran',
            ]),
            'tempat'             => $this->faker->randomElement([
                'Kantor Bupati', 'Aula Pemda', 'Ruang Rapat Utama', 'Gedung DPRD',
                'Dinas Keuangan', 'Badan Kepegawaian', 'Kantor Dinas Pendidikan',
                'Ruang Inspektur', 'Aula Inspektorat',
            ]),
            'keterangan'         => $this->faker->paragraph(2),
            'division_id'        => Division::inRandomOrder()->first()?->id,
            'status_pelaksanaan' => $this->faker->randomElement(['Selesai', 'Pending', 'Dalam Proses', 'Dibatalkan']),
        ];
    }
}
