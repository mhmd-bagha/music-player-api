<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function albums(): JsonResponse
    {
        $albums = Album::all();
        return response()->json(['data' => $albums, 'status' => 200]);
    }
}
