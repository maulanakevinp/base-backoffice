<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    protected $table = "submenu";
    protected $guarded = [];
    public $timestamps = false;

    public function sub_submenu()
    {
        return $this->hasMany(SubSubmenu::class);
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
