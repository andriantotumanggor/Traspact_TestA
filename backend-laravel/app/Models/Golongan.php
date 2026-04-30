<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Golongan extends Model
{
    protected $table = 'golongan';
    protected $fillable = ['nama'];

    public function pegawai(): HasMany
    {
        return $this->hasMany(Pegawai::class);
    }
}
