<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKelamin extends Model
{
    protected $table = 'jenis_kelamin';
    protected $guarded = [];
    public $timestamps = false;

    public function user_detail()
    {
        return $this->hasMany(UserDetail::class);
    }
}
