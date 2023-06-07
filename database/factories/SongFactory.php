<?php

namespace Database\Factories;

use App\Models\Song;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{

    protected $model = Song::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'image' => 'https://i.scdn.co/image/ab676161000051746ea2260c54d4aa0f2ba9762e',
            'time' => fake()->time('i:s'),
            'album_id' => fake()->randomNumber(1)
        ];
    }
}
