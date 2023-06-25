<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class SongPopular extends Model
{
    use HasFactory;

    protected $table = 'like_songs';
    protected $fillable = ['song_id', 'user_id'];

    public function likes(): HasOne
    {
        return $this->hasOne(SongPopular::class, 'id', 'song_id');
    }

    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class, 'song_id', 'id');
    }
}
