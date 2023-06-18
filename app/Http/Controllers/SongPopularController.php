<?php

namespace App\Http\Controllers;

use App\Models\SongPopular;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SongPopularController extends Controller
{
    public function songsLiked(Request $request): JsonResponse
    {
        $songsLiked = SongPopular::where('user_id', $request->user_id)->get();

        return response()->json(['data' => $songsLiked, 'status' => 200]);
    }

    public function addSongLike(Request $request): JsonResponse
    {
        $validator = Validator::make($request->post(), [
            'song_id' => 'required'
        ]);
        if ($validator->fails())
            return response()->json(['message' => $validator->errors(), 'status' => 417], 417);

        $songId = $validator->validated()['song_id'];
        $data = [$songId, $request->user_id];

        $addSongLike = SongPopular::create($data);

        return ($addSongLike) ? response()->json(['message' => 'song added successfully', 'status' => 200]) : response()->json(['message' => 'an error has occurred', 'status' => 500]);
    }
}
