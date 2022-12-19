<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JudulMenu extends Model
{
    protected $table = "judul_menu";
    protected $guarded = [];
    public $timestamps = false;

    public function menu()
    {
        return $this->hasMany(menu::class);
    }

    public function peran_judul_menu()
    {
        return $this->hasMany(PeranJudulMenu::class);
    }
}
