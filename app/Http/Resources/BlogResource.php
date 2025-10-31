<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $category = $this->whenLoaded('category');
        $media = $this->whenLoaded('media');
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'category' => $category ? [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
            ] : null,
            'subtitle' => $this->subtitle,
            'short_description' => $this->short_description,
            'media_url' => $media
                ? getAssetFileUrl('media', $media->file_name, disk: $media->disk)
                : null,
            'media_alt_name' => $media?->alt_name,
        ];
    }
}
