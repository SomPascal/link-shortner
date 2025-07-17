<?php

namespace App\Services\ShortUrlService;

use App\Constants\Shortner;
use App\Models\ShortUrl;
use App\Services\ShortUrlService\DTO\LinkStats;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ShortUrlService
{
    public function create(string $url): ShortUrl
    {
        $code = Str::random(Shortner::LINK_CODE_LENGTH);

        return ShortUrl::create([
            'original_url' => $url,
            'short_code' => $code
        ]);
    }

    // TODO: Handle clicks implementaion using transactions
    public function resolve(string $code): ?ShortUrl
    {
        $shorUrl = ShortUrl::findByCode($code);

        if (empty($shorUrl) || ($shorUrl->expire_at && $shorUrl->expire_at->isPast())) {
            return null;
        }

        try {
            DB::transaction(function () use ($shorUrl) {
                $shorUrl->increment('click_count');
        
                $shorUrl->clicks()->create([
                    'clicked_at' => now()
                ]);
            });
        } catch (\Throwable $th) {
            report($th);
        }

        return $shorUrl;
    }

    public function stats(string $code): ?LinkStats
    {
        $shorUrl = ShortUrl::findByCode($code);

        if (empty($shorUrl)) {
            return null;
        }

        return new LinkStats(
            originalUrl: $shorUrl->original_url,
            shortCode: $shorUrl->short_code,
            clickCount: $shorUrl->click_count,
            createdAt: $shorUrl->created_at
        );
    }
}