<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name'    => 'Admin',
                'color'    => 'dark',
            ],
            [
                'name'    => 'Kepala Sekolah',
                'color'    => 'primary',
            ],
            [
                'name'    => 'Tata Usaha',
                'color'    => 'success',
            ],
            [
                'name'    => 'Wali Kelas',
                'color'    => 'danger',
            ],
            [
                'name'    => 'Guru Pelajaran',
                'color'    => 'warning',
            ],
            [
                'name'    => 'Penjaga Sekolah',
                'color'    => 'info',
            ],
        ];

        foreach ($datas as $data) {
            Role::updateOrCreate(['name' => $data['name']], $data);
        }
    }
}
