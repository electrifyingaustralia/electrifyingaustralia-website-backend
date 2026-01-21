<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'title'             => $this->title,
            'slug'              => $this->slug,
            'subtitle'          => $this->subtitle,
            'short_description' => $this->short_description,
            'description'       => $this->description,
            'reading_time'      => $this->reading_time,
            'meta_title'        => $this->meta_title,
            'meta_description'  => $this->meta_description,
            'keywords'          => $this->keywords,
            'category'          => $this->category->name,

            // Social media links
            'social_links' => [
                'facebook'  => $this->facebook_link,
                'twitter'   => $this->twitter_link,
                'linkedin'  => $this->linkedin_link,
                'youtube'   => $this->youtube_link,
            ],

            // Media
            'media' => $this->whenLoaded('media', function () {
                return [
                    'media_url' => getAssetFileUrl("media", $this->media->file_name, disk: $this->media->disk),
                    'alt_name'  => $this->media->alt_name,
                ];
            }),
        ];
    }
}
