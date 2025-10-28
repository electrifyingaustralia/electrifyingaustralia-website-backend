<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'subtitle' => $this->subtitle,
            'media_url' => $this->whenLoaded("media", function ($media) {
                return getAssetFileUrl("media", $media->file_name, disk: $media->disk);
            }),
            'is_active' => $this->is_active,
        ];
    }
}
