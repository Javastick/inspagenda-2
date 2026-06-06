<?php

namespace Database\Seeders;

use App\Models\Auditor;
use App\Models\Division;
use App\Models\InviteMail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create 1 Admin Account
        User::firstOrCreate(
            ['email' => 'admin@inspagenda.test'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        // 2. Create the Divisions
        $divisionNames = ['Inspektur', 'Irban 1', 'Irban 2', 'Irban 3', 'Irban 4', 'Irban Khusus', 'Sekretariat'];
        $divisions = [];
        foreach ($divisionNames as $name) {
            $divisions[] = Division::firstOrCreate(['name' => $name]);
        }

        // 3. Create Auditors - menggunakan jumlah template dari AuditorFactory
        $templateCount = count(\Database\Factories\AuditorFactory::$defaultAuditors);
        $allAuditors = Auditor::factory($templateCount)->create();

        // 4. Create InviteMail records
        $inviteMails = InviteMail::factory(100)->create();

        // 5. Attach auditors to invite_mails via pivot table
        foreach ($inviteMails as $inviteMail) {
            // Only use auditors from the same division if division_id is set
            if ($inviteMail->division_id) {
                $candidates = Auditor::where('division_id', $inviteMail->division_id)
                    ->inRandomOrder()
                    ->take(rand(1, 4)) // Bisa 1 sampai 4 orang atau lebih
                    ->pluck('id')
                    ->toArray();
            } else {
                $candidates = $allAuditors->random(rand(1, 4))->pluck('id')->toArray();
            }

            $inviteMail->auditors()->sync($candidates);
        }
    }
}
