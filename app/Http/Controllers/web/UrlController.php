<?php

namespace App\Http\Controllers\web;

use App\Constants\Pagination;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\ShortUrlRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class UrlController extends Controller
{
    public function __construct(
        protected ShortUrlRepository $shortUrlRepository
    ) {}

    public function list(): View
    {
        /**
         * @var User $user
         */
        $user = Auth::user();

        return view('url', [
            'urls' => $this->shortUrlRepository->getShortUrlsByUser($user)
        ]);
    }
}
