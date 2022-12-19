<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JudulMenuMenu extends Model
{
    protected $table = 'judul_menu_menu';
    protected $guarded = [];

    public function peran_judul_menu()
    {
        return $this->belongsTo(PeranJudulMenu::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function menu_submenu()
    {
        return $this->hasMany(MenuSubmenu::class);
    }
}
