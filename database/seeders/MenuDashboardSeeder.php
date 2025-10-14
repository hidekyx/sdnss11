<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuDashboard;

class MenuDashboardSeeder extends Seeder
{
    public function run(): void
    {
        MenuDashboard::truncate();

        $dashboard = MenuDashboard::create([
            'name' => 'Dashboard',
            'icon' => 'home',
            'route' => 'dashboard',
        ]);

        $pembelajaran = MenuDashboard::create([
            'name' => 'Pembelajaran',
            'icon' => 'database',
            'route' => null,
        ]);

        // Sub Menu
        MenuDashboard::create([
            'parent_id' => $pembelajaran->id,
            'name' => 'Guru dan Tendik',
            'icon' => 'users',
            'route' => 'dashboard-pembelajaran-guru-dan-tendik',
        ]);
        
        MenuDashboard::create([
            'parent_id' => $pembelajaran->id,
            'name' => 'Siswa',
            'icon' => 'users',
            'route' => 'dashboard-pembelajaran-siswa',
        ]);

        MenuDashboard::create([
            'parent_id' => $pembelajaran->id,
            'name' => 'Kelas',
            'icon' => 'users',
            'route' => 'kelas',
        ]);

        $pelajaran = MenuDashboard::create([
            'parent_id' => $pembelajaran->id,
            'name' => 'Pelajaran',
            'icon' => 'users',
            'route' => null,
        ]);

        // Child Menu
        MenuDashboard::create([
            'parent_id' => $pelajaran->id,
            'name' => 'Mata Pelajaran',
            'icon' => 'users',
            'route' => 'mata-pelajaran',
        ]);

        MenuDashboard::create([
            'parent_id' => $pelajaran->id,
            'name' => 'Jadwal Pelajaran',
            'icon' => 'users',
            'route' => 'jadwal-pelajaran',
        ]);
    }
}
