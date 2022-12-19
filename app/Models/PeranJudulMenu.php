<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeranJudulMenu extends Model
{
    protected $table = 'peran_judul_menu';
    protected $guarded = [];

    public function peran()
    {
        return $this->belongsTo(Peran::class);
    }

    public function judul_menu()
    {
        return $this->belongsTo(JudulMenu::class);
    }

    public function judul_menu_menu()
    {
        return $this->hasMany(JudulMenuMenu::class);
    }
}
