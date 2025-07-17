<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ShortenUrlRequest;
use App\Http\Resources\ShortenUrlResource;
use App\Http\Resources\ShortenUrlStatsResource;
use App\Services\ShortUrlService\ShortUrlService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UrlShortenerController extends Controller
{
    public function __construct(
        protected ShortUrlService $shortUrlService
    ) {}

    public function shorten(ShortenUrlRequest $request): JsonResponse
    {
        $shortUrl = $this->shortUrlService->create($request->validated('url'));

        return response()->json(
            new ShortenUrlResource($shortUrl)
        );
    }

    public function stats(string $code): JsonResponse
    {
        $stats = $this->shortUrlService->stats($code);

        if (empty($stats)) {
            return response()->json(
                status: Response::HTTP_NOT_FOUND
            );
        }

        return response()->json(
            new ShortenUrlStatsResource($stats)
        );
    }
}
