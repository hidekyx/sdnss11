<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MenuDashboard;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GuruDanTendikController extends Controller
{
    public $mainMenu    = "Pembelajaran";
    public $subMenu     = "Guru dan Tendik";

    public function index(Request $request): View
    {
        $user = User::with('role')->orderBy('id');
        $this->applyFilters($user, $request);

        $additionalData = [
            'menus' => MenuDashboard::whereNull('parent_id')->with('children')->get(),
            'user' => $user->get(),
            'kategoriRole' => Role::get(),
        ];

        return $this->createView('Daftar', 'dashboard.pembelajaran.guru-dan-tendik.index', $additionalData);
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

    private function applyFilters($query, Request $request): void
    {
        $searchQuery = $request->query('search');
        $roleQuery = $request->query('role');

        if ($searchQuery) {
            $query->search($searchQuery);
        }

        if ($roleQuery) {
            $query->role($roleQuery);
        }
    }
}
