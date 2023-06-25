<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SongsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'image' => $this->image,
            'time' => $this->time,
            'src' => $this->src,
            'album_id' => $this->album_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
