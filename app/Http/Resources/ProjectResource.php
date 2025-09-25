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
            'short_description' => $this->short_description,
            'solar_panel' => $this->solar_panel,
            'inverter' => $this->inverter,
            'type' => $this->type,
            'type_name' => $this->getTypeNameAttribute(),
            'location' => $this->location,
            'media_id' => $this->media_id,
            'media_url' => $this->media_url,
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
        ];
    }
}
