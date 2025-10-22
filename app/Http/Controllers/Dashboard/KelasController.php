<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\KelasGuru;
use App\Models\KelasSiswa;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public $mainMenu    = "Pembelajaran";
    public $subMenu     = "Kelas";

    public function index(Request $request): View
    {

        $kelas = Kelas::orderBy('id');
        $this->applyFilters($kelas, $request);

        $additionalData = [
            'kelas' => $kelas->get(),
        ];

        return $this->createView('List', 'dashboard.pembelajaran.kelas.index', $additionalData);
    }

    public function tahunAjaran($id): View
    {
        $kelas = Kelas::findOrfail($id);
        $tahunAjaran = TahunAjaran::orderByDesc('id')->get();
        $additionalData = [
            'kelas' => $kelas,
            'tahunAjaran' => $tahunAjaran,
        ];

        return $this->createView('Tahun Ajaran', 'dashboard.pembelajaran.kelas.tahun-ajaran', $additionalData);
    }

    public function setting($kelasId, $tahunAjaranId): View
    {
        $kelas = Kelas::findOrfail($kelasId);
        $tahunAjaran = TahunAjaran::findOrfail($tahunAjaranId);
        $kelasSiswa = KelasSiswa::where('kelas_id', $kelasId)->where('tahun_ajaran_id', $tahunAjaranId)->get();
        $kelasGuru = KelasGuru::where('kelas_id', $kelasId)->where('tahun_ajaran_id', $tahunAjaranId)->first();
        $waliKelas = User::where('role_id', 4)->get();
        $guruPelajaran = User::where('role_id', 5)->get();
        $siswa = Siswa::get();
        $additionalData = [
            'kelas' => $kelas,
            'tahunAjaran' => $tahunAjaran,
            'kelasSiswa' => $kelasSiswa,
            'kelasGuru' => $kelasGuru,
            'waliKelas' => $waliKelas,
            'guruPelajaran' => $guruPelajaran,
            'siswa' => $siswa,
        ];

        return $this->createView('Pengaturan', 'dashboard.pembelajaran.kelas.setting', $additionalData);
    }

    public function perbaharui($request, $id)
    {
        try {
            

            return redirect()->route('dashboard-pembelajaran-siswa')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_icon' => 'mdi-check-circle-outline',
                    'alert_messages' => ['Data kelas berhasil diperbaharui.'],
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
