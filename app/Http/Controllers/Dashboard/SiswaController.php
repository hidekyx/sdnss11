<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiswaRequest;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public $mainMenu    = "Pembelajaran";
    public $subMenu     = "Siswa";

    public function index(Request $request): View
    {

        $siswa = Siswa::with('kelas')->orderBy('id');
        $this->applyFilters($siswa, $request);

        $additionalData = [
            'siswa' => $siswa->paginate(50),
            'kelas' => Kelas::get(),
        ];

        return $this->createView('List', 'dashboard.pembelajaran.siswa.index', $additionalData);
    }

    public function create(): View
    {
        return $this->createView('Tambah', 'dashboard.pembelajaran.siswa.form');
    }

    public function store(SiswaRequest $request)
    {   
        try {
            $data = $request->validated();

            if ($request->hasFile('avatar')) {
                $data['avatar'] = storeFile($request->file('avatar'), 'images/avatar');
            }

            $data['tanggal_lahir'] = $data['tanggal_lahir_submit'];
            Siswa::create($data);

            return redirect()->route('dashboard-pembelajaran-siswa')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_icon' => 'mdi-check-circle-outline',
                    'alert_messages' => ['Data siswa berhasil disimpan.'],
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
        $siswa = Siswa::findOrfail($id);
        $additionalData = [
            'siswa' => $siswa,
        ];

        return $this->createView('Edit', 'dashboard.pembelajaran.siswa.form', $additionalData);
    }

    public function update(SiswaRequest $request, $id)
    {
        try {
            $siswa = Siswa::findOrfail($id);
            $data = $request->validated();

            if ($request->hasFile('avatar')) {
                $data['avatar'] = storeFile($request->file('avatar'), 'images/avatar');
            }

            $data['tanggal_lahir'] = $data['tanggal_lahir_submit'];
            $siswa->update($data);

            return redirect()->route('dashboard-pembelajaran-siswa')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_icon' => 'mdi-check-circle-outline',
                    'alert_messages' => ['Data siswa berhasil diperbaharui.'],
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
            $siswa = Siswa::findOrFail($id);
            $siswa->delete();
            return redirect()->route('dashboard-pembelajaran-siswa')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_icon' => 'mdi-check-circle-outline',
                    'alert_messages' => ['Data siswa berhasil dihapus.'],
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
        $kelasQuery = $request->query('kelas');

        if ($searchQuery) {
            $query->search($searchQuery);
        }

        if ($kelasQuery) {
            $query->kelas($kelasQuery);
        }
    }
}
