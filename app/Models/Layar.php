<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layar extends Model
{
    protected $table = "layar";
    protected $guarded = [];
    public $timestamps = false;

    public function kustom_bidang()
    {
        return $this->hasMany(KustomBidang::class);
    }
}
