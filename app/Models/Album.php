<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['singer_name', 'singer_image', 'singer_type'];
    protected $table = 'albums';

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class, 'album_id');
    }
}
