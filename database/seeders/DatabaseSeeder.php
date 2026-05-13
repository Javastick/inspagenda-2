<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        // 1. Create Admin User
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@inspagenda.com'],
            [
                'name' => 'Administrator',
                'password' => \Illuminate\Support\Facades\Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // 2. Create Divisions
        $divisionNames = ['Irban Wilayah I', 'Irban Wilayah II', 'Irban Wilayah III', 'Irban Wilayah IV', 'Irban Investigasi'];
        $divisions = collect();
        foreach ($divisionNames as $name) {
            $divisions->push(\App\Models\Division::create(['name' => $name]));
        }

        // 3. Create Auditors
        $auditors = collect();
        for ($i = 0; $i < 50; $i++) {
            $auditors->push(\App\Models\Auditor::create([
                'name' => $faker->name,
                'status' => $faker->randomElement(['aktif', 'aktif', 'aktif', 'cuti', 'sakit']),
                'division_id' => $divisions->random()->id,
            ]));
        }

        // 4. Create Schedules (InviteMail)
        $kegiatanTipes = ['Audit Kinerja', 'Audit Keuangan', 'Evaluasi SAKIP', 'Monitoring Dana Desa', 'Pemeriksaan Reguler', 'Review RKPD', 'Audit Investigasi', 'Pendampingan ZI'];
        $senders = ['Inspektur Daerah', 'Bupati', 'Kementerian Dalam Negeri', 'BPKP Provinsi', 'KPK RI', 'Sekretaris Daerah'];
        $statusOpts = ['Direncanakan', 'Berjalan', 'Selesai', 'Batal'];

        for ($i = 0; $i < 150; $i++) {
            $isPast = $faker->boolean(60); // 60% past events
            if ($isPast) {
                $hari = $faker->dateTimeBetween('-3 months', 'now');
            } else {
                $hari = $faker->dateTimeBetween('now', '+2 months');
            }

            $schedule = \App\Models\InviteMail::create([
                'sender' => $faker->randomElement($senders),
                'masuk' => $faker->dateTimeBetween('-4 months', $hari)->format('Y-m-d'),
                'hari' => $hari,
                'kegiatan' => $faker->randomElement($kegiatanTipes) . ' di ' . $faker->company,
                'tempat' => $faker->address,
                'keterangan' => $faker->sentence(10),
                'division_id' => $faker->boolean(80) ? $divisions->random()->id : null,
                'status_pelaksanaan' => $isPast ? 'Selesai' : $faker->randomElement(['Direncanakan', 'Berjalan', 'Batal']),
            ]);

            // Assign 2 to 5 random active auditors to this schedule
            $assignedAuditors = $auditors->where('status', 'aktif')->random(rand(2, 5))->pluck('id');
            $schedule->auditors()->attach($assignedAuditors);
        }
    }
}
