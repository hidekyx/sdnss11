<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Ekstrakulikuler;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $view = [
            'beritaTerbaru' => Berita::orderByDesc('published_at')->published()->limit(9)->get(),
            'agendaTerbaru' => Agenda::orderBy('date')->ongoing()->limit(10)->get(),
            'ekstrakulikuler' => Ekstrakulikuler::get(),
        ];

        return view('landing-page.home.index')->with($view);
    }
}
