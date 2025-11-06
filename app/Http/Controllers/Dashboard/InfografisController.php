<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\PublikasiKategori;
use App\Enums\PublikasiStatus;
use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\InfografisRequest;
use App\Models\Infografis;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class InfografisController extends Controller
{
    public $mainMenu    = "Publikasi";
    public $subMenu     = "Infografis";

    public function index(Request $request): View
    {
        $infografis = Infografis::orderByDesc('published_at');
        $this->applyFilters($infografis, $request);

        $additionalData = [
            'infografis' => $infografis->paginate(25),
            'kategoriInfografis' => PublikasiKategori::listKategori(),
        ];

        return $this->createView('List', 'dashboard.publikasi.infografis.index', $additionalData);
    }

    public function create(): View
    {
        $additionalData = [
            'kategoriInfografis' => PublikasiKategori::listKategori(),
            'penanggungJawab' => User::where('role_id', '!=', Role::Admin)->get(),
        ];

        return $this->createView('Tambah', 'dashboard.publikasi.infografis.form', $additionalData);
    }

    public function store(InfografisRequest $request)
    {
        try {
            $data = $request->validated();
            
            if ($request->hasFile('img')) {
                $data['img'] = storeImageWatermark($request->file('img'), 'images/infografis');
            }

            if (isset($data['is_published']) && $data['is_published'] == "on") {
                $data['is_published'] = PublikasiStatus::Published;
            } else {
                $data['is_published'] = PublikasiStatus::Unpublished;
            }

            $infografis = new Infografis($data);

            $infografis->published_at = $data['published_at_submit'];
            $infografis->save();

            return redirect()->route('dashboard-publikasi-infografis')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_icon' => 'mdi-check-circle-outline',
                    'alert_messages' => ['Data infografis berhasil disimpan.'],
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
        $infografis = Infografis::findOrfail($id);
        $additionalData = [
            'infografis' => $infografis,
            'kategoriInfografis' => PublikasiKategori::listKategori(),
            'penanggungJawab' => User::where('role_id', '!=', Role::Admin)->get(),
        ];

        return $this->createView('Edit', 'dashboard.publikasi.infografis.form', $additionalData);
    }

    public function update(InfografisRequest $request, $id)
    {
        try {
            $infografis = Infografis::findOrfail($id);

            $data = $request->validated();

            if ($request->hasFile('img')) {
                $data['img'] = storeImageWatermark($request->file('img'), 'images/infografis');
            }

            $data['published_at'] = $data['published_at_submit'];

            if (isset($data['is_published']) && $data['is_published'] == "on") {
                $data['is_published'] = PublikasiStatus::Published;
            } else {
                $data['is_published'] = PublikasiStatus::Unpublished;
            }

            $infografis->update($data);

            return redirect()->route('dashboard-publikasi-infografis')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_icon' => 'mdi-check-circle-outline',
                    'alert_messages' => ['Data infografis berhasil diperbaharui.'],
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
            $infografis = Infografis::findOrFail($id);
            $infografis->delete();
            return redirect()->route('dashboard-publikasi-infografis')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_icon' => 'mdi-check-circle-outline',
                    'alert_messages' => ['Data infografis berhasil dihapus.'],
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
