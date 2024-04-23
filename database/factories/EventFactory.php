<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(10),
            'school_id' => User::factory(),
            'year_id' => User::factory(),
            'published_at' => $this->faker->dateTimeBetween('-1 Week', '+1 week'),
        ];
    }
}
