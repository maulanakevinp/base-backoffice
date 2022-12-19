<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiUmum extends Model
{
    protected $table = 'informasi_umum';
    protected $guarded = [];

    public function negara()
    {
        return $this->belongsTo(Negara::class,'kode_negara');
    }

}
