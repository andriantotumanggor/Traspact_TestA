<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Kepala Dinas'],
            ['nama' => 'Sekretaris Dinas'],
            ['nama' => 'Kepala Bidang'],
            ['nama' => 'Kepala Sub Bidang'],
            ['nama' => 'Staff Ahli'],
            ['nama' => 'Analis Kebijakan'],
            ['nama' => 'Penyusun Rencana'],
            ['nama' => 'Pengawas Teknis'],
            ['nama' => 'Pelaksana'],
            ['nama' => 'Fungsional Umum'],
            ['nama' => 'Kepala Sekretariat Utama'],
        ];

        foreach ($data as $item) {
            Jabatan::create($item);
        }
    }
}

