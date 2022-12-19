<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jabatan extends Model
{

    protected $table = 'jabatans';
    protected $fillable = [
        'nama',
    ];

    public function pegawai()
    {
        return $this->hasMany(pegawai::class);
    }
}
