<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TempatTugas extends Model
{
    protected $table = 'tempat_tugas';
    protected $fillable = ['nama'];

    public function pegawai(): HasMany
    {
        return $this->hasMany(Pegawai::class);
    }
}
