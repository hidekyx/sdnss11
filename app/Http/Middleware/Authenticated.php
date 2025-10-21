<?php

namespace App\Http\Middleware;

use App\Models\MenuDashboard;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class Authenticated
{
    /**
     * Cek kalau authenticated, lanjut ke dashboard, kalau ngga redirect ke login page.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with([
                    'alert_type' => 'danger',
                    'alert_title' => 'Autentikasi diperlukan!',
                    'alert_icon' => 'mdi-check-circle-outline',
                    'alert_messages' => ['Anda harus login terlebih dahulu!.'],
                ]);
        }

        $menu = MenuDashboard::whereNull('parent_id')->with('children')->get();
        // foreach ($menu as $m) {
        //     foreach($m->children as $c) {
        //         dd($c);
        //     }
        // }
        View::share('menu', $menu);

        return $next($request);
    }
}
