<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeKustomBidang extends Model
{
    protected $table = 'tipe_kustom_bidang';
    protected $guarded = [];
    public $timestamps = false;

    public function detail_kustom_bidang()
    {
        return $this->hasMany(DetailKustomBidang::class);
    }
}
