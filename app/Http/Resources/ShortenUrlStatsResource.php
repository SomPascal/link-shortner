<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortenUrlStatsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'original_url' => $this->resource->originalUrl,
            'short_code' => $this->resource->shortCode,
            'click_count' => $this->resource->clickCount,
            'created_at' => $this->resource->createdAt
        ];
    }
}
