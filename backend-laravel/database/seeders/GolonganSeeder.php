<?php

namespace Database\Seeders;

use App\Models\Golongan;
use Illuminate\Database\Seeder;

class GolonganSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'I/a - Juru Muda'],
            ['nama' => 'I/b - Juru Muda Tingkat I'],
            ['nama' => 'I/c - Juru'],
            ['nama' => 'I/d - Juru Tingkat I'],
            ['nama' => 'II/a - Pengatur Muda'],
            ['nama' => 'II/b - Pengatur Muda Tingkat I'],
            ['nama' => 'II/c - Pengatur'],
            ['nama' => 'II/d - Pengatur Tingkat I'],
            ['nama' => 'III/a - Penata Muda'],
            ['nama' => 'III/b - Penata Muda Tingkat I'],
            ['nama' => 'III/c - Penata'],
            ['nama' => 'III/d - Penata Tingkat I'],
            ['nama' => 'IV/a - Pembina'],
            ['nama' => 'IV/b - Pembina Tingkat I'],
            ['nama' => 'IV/c - Pembina Utama Muda'],
            ['nama' => 'IV/d - Pembina Utama Madya'],
            ['nama' => 'IV/e - Pembina Utama'],
        ];

        foreach ($data as $item) {
            Golongan::create($item);
        }
    }
}

