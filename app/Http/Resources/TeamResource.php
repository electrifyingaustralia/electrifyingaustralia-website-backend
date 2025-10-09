<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            // 'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'designation' => $this->designation,
            'email' => $this->email,
            'phone' => $this->phone,
            'description' => $this->description,
            'media_url' => $this->media_url,
            'status' => $this->status,
            'twitter_link' => $this->twitter_link,
            'instagram_link' => $this->instagram_link,
            'facebook_link' => $this->facebook_link,
            'pinterest_link' => $this->pinterest_link,
            'linkedin_link' => $this->linkedin_link,
            'youtube_link' => $this->youtube_link,
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
        ];
    }
}
