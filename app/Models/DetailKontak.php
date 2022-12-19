<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailKontak extends Model
{
    protected $table = 'detail_kontak';
    protected $guarded = [];

    public function data_pribadi()
    {
        return $this->belongsTo(DataPribadi::class);
    }
}
