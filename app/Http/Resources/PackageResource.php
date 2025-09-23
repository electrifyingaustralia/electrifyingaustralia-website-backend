<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'subtitle'     => $this->subtitle,
            'is_best_deal' => $this->is_best_deal,
            'features'     => $this->whenLoaded('features', function () {
                return $this->features->map(function ($feature) {
                    return [
                        'id'      => $feature->id,
                        'feature' => $feature->feature,
                    ];
                });
            }),
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
        ];
    }
}
