<?php

namespace App\Http\Controllers\LandingPage;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Ekstrakulikuler;
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

    public function ekstrakulikuler(Request $request): View
    {
        $additionalData = [
            'ekstrakulikuler' => Ekstrakulikuler::get(),
        ];

        return $this->createView('Ekstrakulikuler', 'landing-page.kesiswaan.ekstrakulikuler-list', $additionalData);
    }

    public function ekstrakulikulerDetail(Request $request, $nama): View
    {
        $ekstrakulikuler = Ekstrakulikuler::where('nama', str_replace('-', ' ', $nama));
        $additionalData = [
            'ekstrakulikuler' => $ekstrakulikuler->firstOrFail(),
            'kelas' => Kelas::orderBy('id')->get(),
        ];

        // dd($additionalData['ekstrakulikuler']->siswa->first()->siswa->kelas);

        return $this->createView('Ekstrakulikuler', 'landing-page.kesiswaan.ekstrakulikuler-detail', $additionalData);
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
