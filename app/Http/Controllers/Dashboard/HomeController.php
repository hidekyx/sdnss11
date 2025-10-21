<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public $mainMenu    = "Dashboard";
    public $subMenu     = "Home";

    public function index(): View
    {
        $additionalData = [
            
        ];

        return $this->createView('Home', 'dashboard.home.index', $additionalData);
    }

    private function createView(string $detailMenu, string $viewPath, array $additionalData = []): View
    {
        $view = array_merge([
            'mainMenu' => $this->mainMenu,
            'subMenu' => $this->subMenu,
            'detailMenu' => $detailMenu,
        ], $additionalData);

        return view($viewPath)->with($view);
    }
}
