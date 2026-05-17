<?php

namespace Database\Factories;

use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuditorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'division_id' => Division::inRandomOrder()->first()?->id ?? 1,
            'name'        => $this->faker->name(),
            'status'      => $this->faker->randomElement(['aktif', 'aktif', 'aktif', 'non-aktif']),
        ];
    }
}
