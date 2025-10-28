<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            'media_url' => $this->media_url,
            'category' => $this->category,
            'type' => $this->type->name,
            'location' => $this->location,
            'is_in_homepage_solution' => $this->is_solution,
            'extra_info_1' => $this->extra_info_1,
            'extra_info_2' => $this->extra_info_2,
            'extra_info_3' => $this->extra_info_3,
            'extra_info_4' => $this->extra_info_4,
            'extra_info_5' => $this->extra_info_5,
            'images' => $this->image_urls,
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
        ];
    }
}
