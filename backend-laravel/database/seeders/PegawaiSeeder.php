<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        Pegawai::create([
'nip' => '197001011975031001',
            'nama' => 'Saifulloh Rifai',
            'tempat_lahir' => 'Jakarta',
            'tgl_lahir' => '1970-01-01',
            'alamat' => 'Jl. Merdeka No. 1, Jakarta',
            'jk' => 'L',
            'agama' => 'Islam',
            'no_hp' => '081234567890',
            'npwp' => '09.123.456.7-123.000',
            'foto' => null,
            'golongan_id' => 9,
            'eselon_id' => 1,
            'jabatan_id' => 1,
            'unit_kerja_id' => 1,
            'tempat_tugas_id' => 1,
        ]);

        Pegawai::create([
            'nip' => '198702152012022002',
            'nama' => 'Ani Wulandari',
            'tempat_lahir' => 'Bandung',
            'tgl_lahir' => '1987-02-15',
            'alamat' => 'Jl. Sudirman No. 45, Bandung',
            'jk' => 'P',
            'agama' => 'Kristen',
            'no_hp' => '082345678901',
            'npwp' => '09.234.567.8-234.000',
            'foto' => null,
            'golongan_id' => 7,
            'eselon_id' => 2,
            'jabatan_id' => 2,
            'unit_kerja_id' => 2,
            'tempat_tugas_id' => 2,
        ]);

        Pegawai::create([
            'nip' => '199003202015031003',
            'nama' => 'Candra Wijaya',
            'tempat_lahir' => 'Surabaya',
            'tgl_lahir' => '1990-03-20',
            'alamat' => 'Jl. Thamrin No. 78, Surabaya',
            'jk' => 'L',
            'agama' => 'Islam',
            'no_hp' => '083456789012',
            'npwp' => '09.345.678.9-345.000',
            'foto' => null,
            'golongan_id' => 5,
            'eselon_id' => 3,
            'jabatan_id' => 3,
            'unit_kerja_id' => 6,
            'tempat_tugas_id' => 3,
        ]);

        Pegawai::create([
            'nip' => '198912102014041004',
            'nama' => 'Dewi Lestari',
            'tempat_lahir' => 'Medan',
            'tgl_lahir' => '1989-12-10',
            'alamat' => 'Jl. Gatot Subroto No. 12, Medan',
            'jk' => 'P',
            'agama' => 'Hindu',
            'no_hp' => '084567890123',
            'npwp' => '09.456.789.0-456.000',
            'foto' => null,
            'golongan_id' => 6,
            'eselon_id' => null,
            'jabatan_id' => 5,
            'unit_kerja_id' => 7,
            'tempat_tugas_id' => 4,
        ]);

        Pegawai::create([
            'nip' => '199205052018051005',
            'nama' => 'Eko Prasetyo',
            'tempat_lahir' => 'Semarang',
            'tgl_lahir' => '1992-05-05',
            'alamat' => 'Jl. Diponegoro No. 88, Semarang',
            'jk' => 'L',
            'agama' => 'Islam',
            'no_hp' => '085678901234',
            'npwp' => '09.567.890.1-567.000',
            'foto' => null,
            'golongan_id' => 3,
            'eselon_id' => null,
            'jabatan_id' => 9,
            'unit_kerja_id' => 3,
            'tempat_tugas_id' => 5,
        ]);
    }
}

