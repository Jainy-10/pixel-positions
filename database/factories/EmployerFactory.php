<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employer>
 */
class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'description' => fake()->words(10, true),
            'url' => fake()->url(),
            'logo' => 'http://picsum.photos/seed/'. rand(1, 100),
            'user_id' => User::factory()
        ];
    }
}
