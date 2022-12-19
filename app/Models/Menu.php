<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "menu";
    protected $guarded = [];
    public $timestamps = false;

    public function submenu()
    {
        return $this->hasMany(Submenu::class);
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
