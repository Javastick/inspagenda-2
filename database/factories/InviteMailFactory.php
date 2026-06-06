<?php

namespace Database\Factories;

use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

class InviteMailFactory extends Factory
{
    public function definition(): array
    {
        $masuk = $this->faker->dateTimeBetween('-1 month','now');
        $hari  = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $division_id = $this->faker->randomElement([ 1, 2, 3, 4, 5, 6, 7]);

        return [
            'sender'             => $this->faker->randomElement(['Dinas Kesehatan', 'Dinas Pendidikan', 'Dinas Pekerjaan Umum', 'Badan Pengelola Keuangan', 'Dinas Perhubungan', 'Kecamatan', 'Sekretariat Daerah']) . ' ' . $this->faker->randomElement(['Kota', 'Kabupaten']) . ' ' . $this->faker->city(),
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
            'division_id'        => $division_id,
        ];
    }
}
