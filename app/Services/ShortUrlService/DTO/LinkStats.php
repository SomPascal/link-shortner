<?php

namespace App\Services\ShortUrlService\DTO;

use Carbon\Carbon;

final readonly class LinkStats
{
    public function __construct(
        public string $originalUrl,
        public string $shortCode,
        public int $clickCount,
        public Carbon $createdAt
    ) {}
}