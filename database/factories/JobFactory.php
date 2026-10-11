<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->jobTitle();
        
        return [
            'employer_id' => Employer::factory(),
            'title' => $title,
            'slug' => Str::slug($title . '-' . fake()->unique()->numberBetween(1, 99999)),
            'salary' => fake()->randomElement(['$50, 000 USD', '$90,000 USD', '$150,000 USD']),
            'location' => 'remote',
            'schedule' => 'Full Time',
            'description' => fake()->text(1000),
            'responsibilities' => implode("\n", fake()->sentences(3)),
            'requirements' => implode("\n", fake()->sentences(3)),
            'featured' => false
        ];
    }
}
