<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DivisionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Inspektur', 'Irban 1', 'Irban 2', 'Irban 3', 'Irban 4', 'Irban Khusus', 'Sekretariat'
            ]),
        ];
    }
}
