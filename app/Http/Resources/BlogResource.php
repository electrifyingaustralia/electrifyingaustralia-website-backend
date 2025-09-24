<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'category_id' => $this->blog_category_id,
            'category_name' => $this->category->name,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'media_id' => $this->media_id,
            'media_url' => $this->media_url,
            'facebook_link' => $this->facebook_link,
            'twitter_link' => $this->twitter_link,
            'linkedin_link' => $this->linkedin_link,
            'youtube_link' => $this->youtube_link,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
        ];
    }
}
