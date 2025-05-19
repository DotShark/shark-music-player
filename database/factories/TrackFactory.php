<?php

namespace Database\Factories;

use App\Models\Track;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Track>
 */
class TrackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Track::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid(),
            'title' => fake()->sentence(3),
            'artist' => fake()->name(),
            'file_name' => fake()->unique()->uuid() . '.mp3',
            'image' => fake()->optional()->imageUrl(640, 640, 'music'),
            'displayed' => fake()->boolean(80), // 80% chance of being displayed
            'play_count' => fake()->numberBetween(0, 1000),
        ];
    }
}
