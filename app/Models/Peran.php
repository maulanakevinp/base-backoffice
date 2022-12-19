<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peran extends Model
{
    protected $table = 'peran';
    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function peran_judul_menu()
    {
        return $this->hasMany(PeranJudulMenu::class);
    }
}
