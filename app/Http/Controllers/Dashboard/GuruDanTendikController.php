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

        return $this->createView('Daftar', 'dashboard.pembelajaran.guru-dan-tendik.index', $additionalData);
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
                $data['avatar'] = storeFile($request->file('avatar'), 'public/images/avatar');
            }

            $data['password'] = bcrypt($data['password']);

            User::create($data);

            return redirect()
                ->route('dashboard-pembelajaran-guru-dan-tendik')
                ->with('success', 'Data guru dan tendik berhasil disimpan');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Validasi Gagal!')
                ->withInput();
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
