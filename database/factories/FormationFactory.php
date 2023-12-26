<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Formation>
 */
class FormationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'titre' => fake()->name(),
            'criteres' => fake()->name(),
            'duree' => fake()->randomNumber(),
            'user_id' => User::factory(),
            // 'etat' => fake()->word(),
            // 'archive' => fake()->word(),
            'created_at'=>now(),
            'updated_at'=>now()
        ];
    }
}
