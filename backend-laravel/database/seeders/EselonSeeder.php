<?php

namespace Database\Seeders;

use App\Models\Eselon;
use Illuminate\Database\Seeder;

class EselonSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'I'],
            ['nama' => 'II'],
            ['nama' => 'III'],
            ['nama' => 'IV'],
            ['nama' => 'V'],
        ];

        foreach ($data as $item) {
            Eselon::create($item);
        }
    }
}

