<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name'        => $this->team_name,
            'slug'        => $this->team_slug,
            'designation' => $this->team_designation,
            'media_url'   => getAssetFileUrl("media", $this->team_media_name, disk: $this->team_media_disk),
            'alt_name'   => $this->team_media_alt_name,
        ];
    }
}
