<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Eselon extends Model
{
    protected $table = 'eselon';
    protected $fillable = ['nama'];

    public function pegawai(): HasMany
    {
        return $this->hasMany(Pegawai::class);
    }
}
