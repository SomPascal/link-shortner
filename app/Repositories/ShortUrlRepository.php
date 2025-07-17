<?php

namespace App\Repositories;

use App\Constants\Pagination;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class ShortUrlRepository extends Repository
{
    public function __construct(
        protected ShortUrl $shortUrl
    ) {}

    public function getShortUrlsByUser(User $user): LengthAwarePaginator
    {
        return $user->shortUrls()->orderBy('created_at', 'desc')->paginate(
            perPage: Pagination::URLS_PER_PAGE
        );
    }
}