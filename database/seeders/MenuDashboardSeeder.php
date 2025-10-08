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

        $dataSekolah = MenuDashboard::create([
            'name' => 'Data Sekolah',
            'icon' => 'database',
            'route' => null,
        ]);

        // Sub Menu
        MenuDashboard::create([
            'parent_id' => $dataSekolah->id,
            'name' => 'Guru dan Tendik',
            'icon' => 'users',
            'route' => 'guru-dan-tendik',
        ]);
        
        MenuDashboard::create([
            'parent_id' => $dataSekolah->id,
            'name' => 'Siswa',
            'icon' => 'users',
            'route' => 'siswa',
        ]);

        MenuDashboard::create([
            'parent_id' => $dataSekolah->id,
            'name' => 'Kelas',
            'icon' => 'users',
            'route' => 'kelas',
        ]);

        $pelajaran = MenuDashboard::create([
            'parent_id' => $dataSekolah->id,
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
