<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->project_id,
            'title'     => $this->project_title,
            'slug'      => $this->project_slug,
            'subtitle'  => $this->project_subtitle,
            'location'  => $this->project_location,
            'category'  => $this->project_category,
            'media_url' => getAssetFileUrl("media", $this->project_media_name, disk: $this->project_media_disk),
            'alt_name'  => $this->project_media_alt_name,
            'type'      => $this->project_type_name,
            'is_in_homepage_solution' => (bool) $this->project_is_solution,
        ];
    }
}
