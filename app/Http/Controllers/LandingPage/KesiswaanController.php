<?php

namespace App\Http\Controllers\LandingPage;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class KesiswaanController extends Controller
{
    public $mainMenu = "Profil";
    public $subMenu;

    public function kelasDanSiswa(Request $request): View
    {
        $this->subMenu = "Kelas dan Siswa";
        $kelas = Kelas::orderBy('id');
        $siswa = Siswa::orderBy('id');

        $additionalData = [
            'siswa' => $siswa->get(),
            'kelas' => $kelas->get(),
        ];

        return $this->createView('Kelas dan Siswa', 'landing-page.kesiswaan.kelas-dan-siswa', $additionalData);
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
