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

        // 2. Create the 4 fixed Divisions (Irban 1-4)
        $divisionNames = ['Irban 1', 'Irban 2', 'Irban 3', 'Irban 4'];
        $divisions = [];
        foreach ($divisionNames as $name) {
            $divisions[] = Division::firstOrCreate(['name' => $name]);
        }

        // 3. Create Auditors - strictly one auditor per division (10 per division = 40 total)
        $allAuditors = collect();
        foreach ($divisions as $division) {
            $auditors = Auditor::factory(10)->create(['division_id' => $division->id]);
            $allAuditors = $allAuditors->merge($auditors);
        }

        // 4. Create 200 InviteMail records
        // $inviteMails = InviteMail::factory(200)->create();

        // 5. Attach auditors to invite_mails via pivot table (random, 1-3 auditors per mail)
        // foreach ($inviteMails as $inviteMail) {
        //     // Only use auditors from the same division if division_id is set
        //     if ($inviteMail->division_id) {
        //         $candidates = Auditor::where('division_id', $inviteMail->division_id)
        //             ->inRandomOrder()
        //             ->take(rand(1, 3))
        //             ->pluck('id')
        //             ->toArray();
        //     } else {
        //         $candidates = $allAuditors->random(rand(1, 3))->pluck('id')->toArray();
        //     }

        //     $inviteMail->auditors()->sync($candidates);
        // }
    }
}
