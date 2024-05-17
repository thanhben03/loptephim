<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name,
            'slug' => Str::random(50),
            'thumbnail' => 'https://picsum.photos/200/300',
            'desc' => Str::random(100),
            'is_vietsub' => $this->faker->randomDigit(0,1),
            'release_date' => $this->faker->date(),
        ];
    }
}
