<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->blog_id,
            'title'     => $this->blog_title,
            'slug'      => $this->blog_slug,
            'category'  =>  [
                'name'  => $this->blog_category_name,
                'slug'  => $this->blog_category_slug,
            ],
            'subtitle'          => $this->blog_subtitle,
            'short_description' => $this->blog_short_description,
            'reading_time'      => $this->blog_reading_time,
            'media_url'         =>  getAssetFileUrl('media', $this->blog_media_name, disk: $this->blog_media_disk),
            'media_alt_name'    => $this->blog_media_alt_name,
        ];
    }
}
