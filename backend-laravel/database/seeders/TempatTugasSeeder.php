<?php

namespace Database\Seeders;

use App\Models\TempatTugas;
use Illuminate\Database\Seeder;

class TempatTugasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Kantor Pusat'],
            ['nama' => 'Cabang Jakarta'],
            ['nama' => 'Cabang Surabaya'],
            ['nama' => 'Cabang Bandung'],
            ['nama' => 'Cabang Medan'],
            ['nama' => 'Cabang Makassar'],
            ['nama' => 'Cabang Semarang'],
        ];

        foreach ($data as $item) {
            TempatTugas::create($item);
        }
    }
}

