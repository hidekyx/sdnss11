<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
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
        $berita = Berita::published()->orderByDesc('published_at')->published();
        $this->applyFilters($berita, $request);

        $additionalData = [
            'berita' => $berita->paginate(10),
            'beritaTerbaru' => Berita::published()->orderByDesc('published_at')->limit(3)->get(),
            'beritaPenanda' => Berita::getOrderByTagCount(),
            'kategoriBerita' => Berita::published()->latestWithTotal()->get(),
        ];

        return $this->createView('Berita', 'landing-page.publikasi.berita-list', $additionalData);
    }

    public function beritaDetail(Request $request, $slug): View
    {
        $this->subMenu = "Berita";
        $berita = Berita::published()->where('slug', $slug)->firstOrFail();
        $berita->tags = $berita->getTagsArray();
        $berita->increment('viewed');
        $this->applyFilters($berita, $request);

        $additionalData = [
            'berita' => $berita,
            'beritaTerbaru' => Berita::published()->orderByDesc('published_at')->limit(3)->get(),
            'beritaPenanda' => Berita::getOrderByTagCount(),
            'kategoriBerita' => Berita::published()->latestWithTotal()->get(),
        ];

        return $this->createView($berita->title, 'landing-page.publikasi.berita-detail', $additionalData);
    }

    public function agendaList(Request $request): View
    {
        $this->subMenu = "Agenda";
        $agenda = Agenda::orderByDesc('date')->published();
        $this->applyFilters($agenda, $request);

        $additionalData = [
            'agenda' => $agenda->paginate(10),
        ];

        return $this->createView('Agenda', 'landing-page.publikasi.agenda-list', $additionalData);
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
