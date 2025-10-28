<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\PublikasiKategori;
use App\Enums\PublikasiStatus;
use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\BeritaRequest;
use App\Models\Berita;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public $mainMenu    = "Publikasi";
    public $subMenu     = "Berita";

    public function index(Request $request): View
    {
        $berita = Berita::orderByDesc('published_at');
        $this->applyFilters($berita, $request);

        $additionalData = [
            'berita' => $berita->paginate(25),
            'kategoriBerita' => PublikasiKategori::listKategori(),
        ];

        return $this->createView('List', 'dashboard.publikasi.berita.index', $additionalData);
    }

    public function create(): View
    {
        $additionalData = [
            'kategoriBerita' => PublikasiKategori::listKategori(),
            'tags' => Tag::orderBy('title')->get(),
            'user' => User::where('role_id', '!=', Role::Admin)->get(),
        ];

        return $this->createView('Tambah', 'dashboard.publikasi.berita.form', $additionalData);
    }

    public function store(BeritaRequest $request)
    {
        try {
            $data = $request->validated();

            $imageKeys = ['img', 'img_2', 'img_3', 'img_4', 'img_5', 'img_6', 'img_7'];
            foreach ($imageKeys as $key) {
                if ($request->hasFile($key)) {
                    $data[$key] = storeBeritaImage($request->file($key), 'images/berita');

                    if ($request->hasFile('img') && $key == 'img') {
                        $file = $request->file('img');
                        $path = 'public/images/berita/thumbnail';
                        $filename = createThumbnail($file, $path);
                        $data['thumbnail'] = $filename;
                    }
                }
            }

            if (isset($data['is_published']) && $data['is_published'] == "on") {
                $data['is_published'] = PublikasiStatus::Published;
            } else {
                $data['is_published'] = PublikasiStatus::Unpublished;
            }

            $berita = new Berita($data);
            if ($request->has('tags')) {
                $berita->tags = implode(', ', $berita->tags);
            }

            $berita->published_at = $data['published_at_submit'];
            $berita->slug = Str::slug(Str::limit($berita->title, 200, ''));
            $berita->writer_id = Auth::id();

            $berita->save();

            return redirect()->route('dashboard-publikasi-berita')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_icon' => 'mdi-check-circle-outline',
                    'alert_messages' => ['Data berita berhasil disimpan.'],
                ]);
        } catch (\Exception $e) {
            return back()
                ->with([
                    'alert_type' => 'danger',
                    'alert_title' => 'Validasi Gagal!',
                    'alert_icon' => 'mdi-alert',
                    'alert_messages' => [$e->getMessage()],
                ]);
        }
    }

    public function edit($id): View
    {
        $berita = Berita::findOrfail($id);
        $berita->tags = explode(', ', $berita->tags);
        $additionalData = [
            'berita' => $berita,
            'kategoriBerita' => PublikasiKategori::listKategori(),
            'tags' => Tag::orderBy('title')->get(),
            'user' => User::where('role_id', '!=', Role::Admin)->get(),
        ];

        return $this->createView('Edit', 'dashboard.publikasi.berita.form', $additionalData);
    }

    public function update(BeritaRequest $request, $id)
    {
        try {
            $berita = Berita::findOrfail($id);

            $data = $request->validated();

            $imageKeys = ['img', 'img_2', 'img_3', 'img_4', 'img_5', 'img_6', 'img_7'];
            foreach ($imageKeys as $index => $key) {
                if ($request->hasFile($key)) {
                    $data[$key] = storeBeritaImage($request->file($key), 'images/berita');
                }
            }

            if ($request->has('tags')) {
                $data['tags'] = implode(', ', $data['tags']);
            } else {
                $data['tags'] = null;
            }

            $data['slug'] = Str::slug(Str::limit($data['title'], 200, ''));
            $data['published_at'] = $data['published_at_submit'];

            if (isset($data['is_published']) && $data['is_published'] == "on") {
                $data['is_published'] = PublikasiStatus::Published;
            } else {
                $data['is_published'] = PublikasiStatus::Unpublished;
            }

            $berita->update($data);

            return redirect()->route('dashboard-publikasi-berita')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_icon' => 'mdi-check-circle-outline',
                    'alert_messages' => ['Data berita berhasil diperbaharui.'],
                ]);
        } catch (\Exception $e) {
            return back()
                ->with([
                    'alert_type' => 'danger',
                    'alert_title' => 'Validasi Gagal!',
                    'alert_icon' => 'mdi-alert',
                    'alert_messages' => [$e->getMessage()],
                ]);
        }
    }

    public function delete($id)
    {
        try {
            $berita = Berita::findOrFail($id);
            $berita->delete();
            return redirect()->route('dashboard-publikasi-berita')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_icon' => 'mdi-check-circle-outline',
                    'alert_messages' => ['Data berita berhasil dihapus.'],
                ]);
        } catch (\Exception $e) {
            return back()
                ->with([
                    'alert_type' => 'danger',
                    'alert_title' => 'Gagal!',
                    'alert_icon' => 'mdi-alert',
                    'alert_messages' => [$e->getMessage()],
                ]);
        }
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
        $statusQuery = $request->query('status');

        if ($searchQuery) {
            $query->search($searchQuery);
        }

        if (!is_null($statusQuery)) {
            $query->status($statusQuery);
        }
    }
}
