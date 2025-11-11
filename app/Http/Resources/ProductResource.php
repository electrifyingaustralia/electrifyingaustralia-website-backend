<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->product_id,
            'name'              => $this->product_name,
            'model_number'      => $this->product_model_number,
            'slug'              => $this->product_slug,
            'short_description' => $this->product_short_description,
            'is_featured'       => $this->product_is_featured,
            'is_active'         => $this->product_is_active,
            'product_link'      => $this->product_product_link,
            'type'              => $this->product_type_name,
            'media_url'         => getAssetFileUrl("media", $this->product_media_name, disk: $this->product_media_disk),
            'alt_name'          => $this->product_media_alt_name,
            'brand'             => $this->brand_id ? [
                'id'       => $this->brand_id,
                'name'     => $this->brand_name,
                'logo_url' => getAssetFileUrl("media", $this->brand_media_name, disk: $this->brand_media_disk),
                'logo_alt_name' => $this->brand_media_alt_name,
            ] : null,

        ];
    }
}
