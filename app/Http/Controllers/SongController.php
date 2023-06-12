<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function songsAlbums(Album $album): JsonResponse
    {
        $songs = $album->songs()->get();

        return response()->json(['data' => $songs, 'status' => 200]);
    }
}
