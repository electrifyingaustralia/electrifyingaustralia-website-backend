<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                             => $this->product_id,
            'name'                           => $this->product_name,
            'model_number'                   => $this->product_model_number,
            'slug'                           => $this->product_slug,
            'short_description'              => $this->product_short_description,
            'is_featured'                    => $this->product_is_featured,
            'is_active'                      => $this->product_is_active,
            'product_link'                   => $this->product_product_link,
            'meta_title'                     => $this->product_meta_title,
            'meta_description'               => $this->product_meta_description,
            'keywords'                       => $this->product_keywords,
            'media_url'                      => getAssetFileUrl("media", $this->product_media_name, disk: $this->product_media_disk),
            'type'                           => $this->product_type_name,
            'product_type_meta_title'        => $this->product_type_meta_title,
            'product_type_meta_description'  => $this->product_type_meta_description,
            'product_type_keywords'          => $this->product_type_keywords,
            'alt_name'                       => $this->product_media_alt_name,
            'brand'                          => $this->brand_id ? [
                'id'                         => $this->brand_id,
                'name'                       => $this->brand_name,
                'logo_url'                   => getAssetFileUrl("media", $this->brand_media_name, disk: $this->brand_media_disk),
                'logo_alt_name'              => $this->brand_media_alt_name,
            ] : null,

        ];
    }
}
