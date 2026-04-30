<?php

namespace Database\Seeders;

use App\Models\UnitKerja;
use Illuminate\Database\Seeder;

class UnitKerjaSeeder extends Seeder
{
    public function run(): void
    {
        $dinas = UnitKerja::create(['nama' => 'Dinas Pendidikan', 'parent_id' => null]);
        $sekretariat = UnitKerja::create(['nama' => 'Sekretariat', 'parent_id' => $dinas->id]);
        UnitKerja::create(['nama' => 'Bagian Kepegawaian', 'parent_id' => $sekretariat->id]);
        UnitKerja::create(['nama' => 'Bagian Keuangan', 'parent_id' => $sekretariat->id]);
        UnitKerja::create(['nama' => 'Bagian Umum', 'parent_id' => $sekretariat->id]);

        $bidang1 = UnitKerja::create(['nama' => 'Bidang Kurikulum', 'parent_id' => $dinas->id]);
        UnitKerja::create(['nama' => 'Sub Bidang SD', 'parent_id' => $bidang1->id]);
        UnitKerja::create(['nama' => 'Sub Bidang SMP', 'parent_id' => $bidang1->id]);

        $bidang2 = UnitKerja::create(['nama' => 'Bidang Sarpras', 'parent_id' => $dinas->id]);
        UnitKerja::create(['nama' => 'Sub Bidang Gedung', 'parent_id' => $bidang2->id]);
        UnitKerja::create(['nama' => 'Sub Bidang Perlengkapan', 'parent_id' => $bidang2->id]);

        $dinas2 = UnitKerja::create(['nama' => 'Dinas Kesehatan', 'parent_id' => null]);
        $sek2 = UnitKerja::create(['nama' => 'Sekretariat Dinkes', 'parent_id' => $dinas2->id]);
        UnitKerja::create(['nama' => 'Bagian Program', 'parent_id' => $sek2->id]);
        UnitKerja::create(['nama' => 'Bagian Keuangan Dinkes', 'parent_id' => $sek2->id]);
    }
}

