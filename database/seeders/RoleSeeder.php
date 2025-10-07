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
                'color'    => '',
            ],
            [
                'name'    => 'Kepala Sekolah',
                'color'    => '',
            ],
            [
                'name'    => 'Tata Usaha',
                'color'    => '',
            ],
            [
                'name'    => 'Wali Kelas',
                'color'    => '',
            ],
            [
                'name'    => 'Guru Pelajaran',
                'color'    => '',
            ],
            [
                'name'    => 'Penjaga Sekolah',
                'color'    => '',
            ],
        ];

        foreach ($datas as $data) {
            Role::updateOrCreate(['name' => $data['name']], $data);
        }
    }
}
