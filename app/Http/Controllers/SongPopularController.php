<?php

namespace App\Http\Controllers;

use App\Models\SongPopular;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SongPopularController extends Controller
{
    public function songsLiked(Request $request): JsonResponse
    {
        $songsLiked = SongPopular::where('user_id', $request->user_id)->get();

        return response()->json(['data' => $songsLiked, 'status' => 200]);
    }
}
