<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'traspac@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('cihuyyy'),
            ]
        );

        $this->call([
            GolonganSeeder::class,
            EselonSeeder::class,
            JabatanSeeder::class,
            UnitKerjaSeeder::class,
            TempatTugasSeeder::class,
            PegawaiSeeder::class,
        ]);
    }
}
