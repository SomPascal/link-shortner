<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\ShortUrlService\ShortUrlService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectController extends Controller
{
    public function __construct(
        protected ShortUrlService $shortUrlService
    ) {}

    public function redirect(string $code): RedirectResponse
    {
        $shortUrl = $this->shortUrlService->resolve($code);

        abort_if(
            boolean: empty($shortUrl),
            code: Response::HTTP_NOT_FOUND
        );

        return redirect()->away($shortUrl->original_url);
    }
}
