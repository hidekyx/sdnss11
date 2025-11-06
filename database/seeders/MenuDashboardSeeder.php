<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuDashboard;

class MenuDashboardSeeder extends Seeder
{
    public function run(): void
    {
        MenuDashboard::truncate();

        $pembelajaran = MenuDashboard::create([
            'name' => 'Pembelajaran',
            'icon' => 'flaticon-381-database',
            'route' => null,
        ]);

        $publikasi = MenuDashboard::create([
            'name' => 'Publikasi',
            'icon' => 'flaticon-381-notepad',
            'route' => null,
        ]);

            // Sub Menu
            MenuDashboard::create([
                'parent_id' => $pembelajaran->id,
                'name' => 'Guru dan Tendik',
                'icon' => null,
                'route' => 'dashboard-pembelajaran-guru-dan-tendik',
            ]);
            
            MenuDashboard::create([
                'parent_id' => $pembelajaran->id,
                'name' => 'Siswa',
                'icon' => null,
                'route' => 'dashboard-pembelajaran-siswa',
            ]);

            MenuDashboard::create([
                'parent_id' => $pembelajaran->id,
                'name' => 'Kelas',
                'icon' => null,
                'route' => 'dashboard-pembelajaran-kelas',
            ]);

            MenuDashboard::create([
                'parent_id' => $publikasi->id,
                'name' => 'Berita',
                'icon' => null,
                'route' => 'dashboard-publikasi-berita',
            ]);

            MenuDashboard::create([
                'parent_id' => $publikasi->id,
                'name' => 'Agenda',
                'icon' => null,
                'route' => 'dashboard-publikasi-agenda',
            ]);

            MenuDashboard::create([
                'parent_id' => $publikasi->id,
                'name' => 'Infografis',
                'icon' => null,
                'route' => 'dashboard-publikasi-infografis',
            ]);
    }
}
