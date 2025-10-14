<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Kelas;
use App\Models\MenuDashboard;
use App\Models\Role;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public $mainMenu    = "Pembelajaran";
    public $subMenu     = "Siswa";

    public function index(Request $request): View
    {

        $siswa = Siswa::with('kelas')->orderByDesc('id');
        $this->applyFilters($siswa, $request);

        $additionalData = [
            'menus' => MenuDashboard::whereNull('parent_id')->with('children')->get(),
            'siswa' => $siswa->paginate(100),
            'kelas' => Kelas::get(),
        ];

        return $this->createView('Daftar', 'dashboard.pembelajaran.siswa.index', $additionalData);
    }

    public function create(): View
    {
        $additionalData = [
            'menus' => MenuDashboard::whereNull('parent_id')->with('children')->get(),
            'kategoriRole' => Role::get(),
        ];

        return $this->createView('Tambah', 'dashboard.pembelajaran.siswa.form', $additionalData);
    }

    public function store(UserRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('avatar')) {
                $data['avatar'] = storeFile($request->file('avatar'), 'images/avatar');
            }

            $data['password'] = bcrypt($data['password']);

            User::create($data);

            return redirect()->route('dashboard-pembelajaran-siswa')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_messages' => ['Data siswa berhasil disimpan.'],
                ]);
        } catch (\Exception $e) {
            return back()
                ->with([
                    'alert_type' => 'danger',
                    'alert_title' => 'Validasi Gagal!',
                    'alert_messages' => [$e],
                ]);
        }
    }

    public function edit($id): View
    {
        $user = User::findOrfail($id);
        $additionalData = [
            'menus' => MenuDashboard::whereNull('parent_id')->with('children')->get(),
            'user' => $user,
            'kategoriRole' => Role::get(),
        ];

        return $this->createView('Edit', 'dashboard.pembelajaran.siswa.form', $additionalData);
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $user = User::findOrfail($id);
            $data = $request->validated();

            if ($request->hasFile('avatar')) {
                $data['avatar'] = storeFile($request->file('avatar'), 'images/avatar');
            }

            $user->update($data);

            return redirect()->route('dashboard-pembelajaran-siswa')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_messages' => ['Data siswa berhasil diperbaharui.'],
                ]);
        } catch (\Exception $e) {
            return back()
                ->with([
                    'alert_type' => 'danger',
                    'alert_title' => 'Validasi Gagal!',
                    'alert_messages' => [$e],
                ]);
        }
    }

    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('dashboard-pembelajaran-siswa')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_messages' => ['Data siswa berhasil dihapus.'],
                ]);
        } catch (\Exception $e) {
            return back()
                ->with([
                    'alert_type' => 'danger',
                    'alert_title' => 'Gagal!',
                    'alert_messages' => [$e],
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
