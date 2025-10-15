<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\MenuDashboard;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GuruDanTendikController extends Controller
{
    public $mainMenu    = "Pembelajaran";
    public $subMenu     = "Guru dan Tendik";

    public function index(Request $request): View
    {

        $user = User::with('role')->orderBy('id');
        $this->applyFilters($user, $request);

        $additionalData = [
            'menus' => MenuDashboard::whereNull('parent_id')->with('children')->get(),
            'user' => $user->paginate(25),
            'kategoriRole' => Role::get(),
        ];

        return $this->createView('List', 'dashboard.pembelajaran.guru-dan-tendik.index', $additionalData);
    }

    public function create(): View
    {
        $additionalData = [
            'menus' => MenuDashboard::whereNull('parent_id')->with('children')->get(),
            'kategoriRole' => Role::get(),
        ];

        return $this->createView('Tambah', 'dashboard.pembelajaran.guru-dan-tendik.form', $additionalData);
    }

    public function store(UserRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('avatar')) {
                $data['avatar'] = storeFile($request->file('avatar'), 'images/avatar');
            }

            $data['password'] = bcrypt($data['password']);
            $data['tanggal_lahir'] = $data['tanggal_lahir_submit'];

            User::create($data);

            return redirect()->route('dashboard-pembelajaran-guru-dan-tendik')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_icon' => 'mdi-check-circle-outline',
                    'alert_messages' => ['Data guru dan tendik berhasil disimpan.'],
                ]);
        } catch (\Exception $e) {
            return back()
                ->with([
                    'alert_type' => 'danger',
                    'alert_title' => 'Validasi Gagal!',
                    'alert_icon' => 'mdi-alert',
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

        return $this->createView('Edit', 'dashboard.pembelajaran.guru-dan-tendik.form', $additionalData);
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $user = User::findOrfail($id);
            $data = $request->validated();

            if ($request->hasFile('avatar')) {
                $data['avatar'] = storeFile($request->file('avatar'), 'images/avatar');
            }

            $data['tanggal_lahir'] = $data['tanggal_lahir_submit'];
            $user->update($data);

            return redirect()->route('dashboard-pembelajaran-guru-dan-tendik')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_messages' => ['Data guru dan tendik berhasil diperbaharui.'],
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
            return redirect()->route('dashboard-pembelajaran-guru-dan-tendik')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_messages' => ['Data guru dan tendik berhasil dihapus.'],
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
        $roleQuery = $request->query('role');

        if ($searchQuery) {
            $query->search($searchQuery);
        }

        if ($roleQuery) {
            $query->role($roleQuery);
        }
    }
}
