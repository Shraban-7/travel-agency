<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        $page = Page::where('slug', 'about')->where('is_active', true)->first();

        return view('public.about', compact('page'));
    }

    public function contact(): View
    {
        $page = Page::where('slug', 'contact')->where('is_active', true)->first();

        return view('public.contact', compact('page'));
    }
}
