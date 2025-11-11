<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectDetailsResource extends JsonResource
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
            'category' => $this->category,
            'location' => $this->location,
            'type' => $this->type->name,
            'is_solution' => $this->is_solution,

            // Extra info fields
            'extra_info_1' => $this->extra_info_1,
            'extra_info_2' => $this->extra_info_2,
            'extra_info_3' => $this->extra_info_3,
            'extra_info_4' => $this->extra_info_4,
            'extra_info_5' => $this->extra_info_5,

            // Main media
            'media' => $this->whenLoaded('media', function () {
                return [
                    'media_url' => getAssetFileUrl("media", $this->media->file_name, disk: $this->media->disk),
                    'alt_name' => $this->media->alt_name,
                ];
            }),

            // Project images gallery
            'images' => $this->whenLoaded('images', function () {
                return $this->images->map(function ($image) {
                    return [
                        'media_url' => getAssetFileUrl("media", $image->file_name, disk: $image->disk),
                        'alt_name' => $image->alt_name,
                    ];
                });
            }),
        ];
    }
}
