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
            'https://audio-fa.scdn.co/audio/2846f72d959db9158bb080d8dfa0235c64a90c1a?1686602164_ggyn3lXhdM5EHfbywhcrKeMz5M3EF4xXWhRO9T9HfM8=',
            'https://audio-fa.scdn.co/audio/a71610952c95f636dc3d624180bb546a547993e0?1686602381_jBSrxGxgcBI7qiAfYflF2PeFS0fJeuO6ipN4JqBGTjk=',
            'https://audio-fa.scdn.co/audio/77da54733ea9556c7df70ddc8526234c7bffd2f8?1686602449_c9bBa3ydT3VvsuwgJqSyKT6LTRtwkPLWYaKHJrbOlF0=',
            'https://audio-fa.scdn.co/audio/e9cbcac54862b0145a47faa1c7276a138e865996?1686602506_kWiBiNGv3h0CAS2IE8nuR7cXnsVd7t-n8QCCMcoFh9o=',
            'https://audio-fa.scdn.co/audio/98ab734573d154f516b954f28ac6455166faeaef?1686602552_pTktd-aIRfliAePu8gmzayMZokebKx9FxSvR3rblNJc=',
            'https://audio-fa.scdn.co/audio/57290d04feebef0391bdb7efeebc0dcde6729e16?1686602636_CG8j8_6EqI_XrP3PTzeDuTyYfRZU1JF3cBetUNJkFYI=',
            'https://audio-fa.scdn.co/audio/4876217b9843bfbc77593cd7513f71a509c539d4?1686602661_qqu2qvKtWuRJoyQeFU6o2EhhInrDc5jkwUEz7L6-MAQ=',
            'https://audio-fa.scdn.co/audio/dd04e4f31e1c153c66f1ccb23a531d6a4ab30236?1686602727_mopgOJj_6sariNhWGYXkwIYPSnKH8f6UlnzFTd08TQ0=',
            'https://audio-fa.scdn.co/audio/e3b762f9bcdb70b0d6ed565b8aabca6a1981f257?1686602778_kDric4h6TchCnrS1HGnz2zutP6j_IVyAZlPu520Lp7Q=',
            'https://audio-fa.scdn.co/audio/efe2dd4dff091485d47ea7d06344b8e5abc1e2bd?1686602868_a7FMNk3vGoimlmcvTQRF1CB1sfiUriqIuB2VRKX3gLk='
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
