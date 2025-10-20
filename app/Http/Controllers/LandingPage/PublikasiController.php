<?php

namespace App\Http\Controllers\LandingPage;

use App\Enums\PublikasiKategori;
use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    public $mainMenu = "Publikasi";
    public $subMenu;

    public function beritaList(Request $request): View
    {
        $this->subMenu = "Berita";
        $berita = Berita::orderByDesc('published_at')->published();
        $this->applyFilters($berita, $request);

        $additionalData = [
            'berita' => $berita->paginate(1),
            'beritaTerbaru' => $berita->limit(3)->get(),
            'kategoriBerita' => Berita::latestWithTotal()->get(),
        ];

        return $this->createView('Berita', 'landing-page.publikasi.berita-list', $additionalData);
    }

    public function beritaDetail($id): View
    {
        $berita = Berita::findOrfail($id);

        $view = [
            'berita' => $berita,
            'kategoriBerita' => PublikasiKategori::listKategori(),
        ];

        return view('landing-page.publikasi.berita-detail')->with($view);
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
        ];

        return view($viewPath)->with(array_merge($view, $additionalData));
    }
}
