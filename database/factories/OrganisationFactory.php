<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organisation>
 */
class OrganisationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'verified' => random_int(0, 1) ? 'Y' : 'N',
            'checkking_all_cards' => random_int(0, 1) ? 'Y' : 'N',
            'id_user' => \App\Models\User::where('role', 'ADM')->inRandomOrder()->first()->id,
        ];
    }
}