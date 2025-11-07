<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            'media' => $this->whenLoaded("media", function ($media) {
                return [
                    'media_url' => getAssetFileUrl("media", $media->file_name, disk: $media->disk),
                    'alt_name' => $media->alt_name,
                ];
            }),
            'images' => $this->whenLoaded("images", function ($images) {
                return $images->map(function ($image) {
                    return [
                        'media_url' => getAssetFileUrl("media", $image->file_name, disk: $image->disk),
                        'alt_name' => $image->alt_name,
                    ];
                });
            }),
        ];
    }
}
