<?php

namespace App\Http\Controllers\web;

use App\Constants\Pagination;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class UrlController extends Controller
{
    public function list(): View
    {
        /**
         * @var User $user
         */
        $user = Auth::user();

        return view('url', [
            'urls' => $user->shortUrls()->paginate(
                perPage: Pagination::URLS_PER_PAGE
            )
        ]);
    }
}
