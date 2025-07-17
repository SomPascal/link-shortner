<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function home(): RedirectResponse
    {
        $route = Auth::check() ? 'account' : 'login';

        return redirect()->route($route);
    }
}
