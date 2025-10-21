<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $view = [
            'beritaTerbaru' => Berita::orderByDesc('published_at')->published()->limit(9)->get(),
        ];

        return view('landing-page.home.index')->with($view);
    }
}
