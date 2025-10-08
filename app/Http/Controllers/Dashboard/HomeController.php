<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MenuDashboard;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $view = [
            'menus' => MenuDashboard::whereNull('parent_id')->with('children')->get(),
        ];

        // dd($view['menu'][1]->children);

        return view('dashboard.home.index')->with($view);
    }
}
