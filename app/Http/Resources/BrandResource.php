<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->brand_id,
            'name'      => $this->brand_name,
            'slug'      => $this->brand_slug,
            'link'      => $this->brand_link,
            'alt_name'  => $this->brand_alt_name,
            'media_url' => getAssetFileUrl("media", $this->brand_media_name, disk: $this->brand_media_disk),
        ];
    }
}
