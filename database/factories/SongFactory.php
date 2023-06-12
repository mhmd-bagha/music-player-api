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
        $songsSrc = [
            'https://ia902504.us.archive.org/31/items/future-mask-off-remix-feat.-kendrick-lamar/Future%20-%20Mask%20Off%20%28Remix%29%20%28feat.%20Kendrick%20Lamar%29.mp3',
            'https://ia601600.us.archive.org/28/items/eminem-the-singles-boxset_202303/01.%20Business.mp3',
            'https://ia601600.us.archive.org/28/items/eminem-the-singles-boxset_202303/01.%20Business.mp3',
            'https://ia600408.us.archive.org/28/items/Eminem_-_Trap_God_2-2015/09%20-%20sing%20for%20the%20moment%20%20-%20ceremony.mp3',
            'https://ia600408.us.archive.org/28/items/Eminem_-_Trap_God_2-2015/11%20-%20BONUS%20TRACK%20fight%20Musik%20%20-%20Beamer%20Benz%20or%20Bentley.mp3',
            'https://ia800408.us.archive.org/28/items/Eminem_-_Trap_God_2-2015/08%20-%20without%20me%20%20-%20paper%20chaser.mp3',
        ];

        $songSrc = fake()->randomElement($songsSrc);

        return [
            'name' => fake()->name(),
            'image' => 'https://i.scdn.co/image/ab676161000051746ea2260c54d4aa0f2ba9762e',
            'time' => fake()->time('i:s'),
            'src' => $songSrc,
            'album_id' => fake()->randomNumber(1)
        ];
    }
}
