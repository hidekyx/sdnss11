<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class AutentikasiController extends Controller
{
    public $mainMenu    = "Autentikasi";
    public $subMenu     = "Login";

    public function login(): View
    {
        $additionalData = [
            
        ];

        return $this->createView('Login', 'dashboard.autentikasi.login', $additionalData);
    }

    public function loginAttempt(LoginRequest $request)
    {
        $data = $request->validated();

        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']], false)) {
            return back()
                ->with([
                    'alert_type' => 'danger',
                    'alert_title' => 'Login Gagal!',
                    'alert_icon' => 'mdi-alert',
                    'alert_messages' => ['Email atau password salah'],
                ]);
        } else {
            $request->session()->regenerate();

            return redirect()->route('dashboard')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_icon' => 'mdi-check-circle-outline',
                    'alert_messages' => ['Berhasil login.'],
                ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('beranda');
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
}
