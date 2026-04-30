<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $fillable = ['nip', 'nama', 'tempat_lahir', 'alamat', 'tgl_lahir', 'jk', 'agama', 'no_hp', 'npwp', 'foto', 'golongan_id', 'eselon_id', 'jabatan_id', 'unit_kerja_id', 'tempat_tugas_id'];

    public function golongan()
    {
        return $this->belongsTo(Golongan::class);
    }

    public function eselon()
    {
        return $this->belongsTo(Eselon::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }

    public function tempatTugas()
    {
        return $this->belongsTo(TempatTugas::class);
    }
}
