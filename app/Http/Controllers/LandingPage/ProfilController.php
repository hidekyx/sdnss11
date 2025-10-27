<?php

namespace App\Http\Controllers\LandingPage;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public $mainMenu = "Profil";
    public $subMenu;

    public function guruDanTendik(Request $request): View
    {
        $this->subMenu = "Guru dan Tendik";
        $guruDanTendik = User::where('role_id', '!=', Role::Admin);

        $additionalData = [
            'guruDanTendik' => $guruDanTendik->get(),
        ];

        return $this->createView('Guru dan Tendik', 'landing-page.profil.guru-dan-tendik', $additionalData);
    }

    private function applyFilters($query, Request $request): void
    {
        $searchQuery = $request->query('search');
        $kategoriQuery = $request->query('kategori');
        $tagQuery = $request->query('tag');

        if ($searchQuery) {
            $query->search($searchQuery);
        }

        if ($kategoriQuery) {
            $query->category($kategoriQuery);
        }

        if ($tagQuery) {
            $query->tag($tagQuery);
        }
    }

    private function createView(string $detailMenu, string $viewPath, array $additionalData = [], string $descMenuOverride = null): View
    {
        $view = [
            'mainMenu' => $this->mainMenu,
            'subMenu' => $this->subMenu,
            'detailMenu' => $detailMenu,
        ];

        return view($viewPath)->with(array_merge($view, $additionalData));
    }
}
