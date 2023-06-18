<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SongPopular extends Model
{
    use HasFactory;

    protected $table = 'like_songs';
    protected $fillable = ['song_id', 'user_id'];

    public function likes(): HasOne
    {
        return $this->hasOne(SongPopular::class, 'id', 'song_id');
    }
}
