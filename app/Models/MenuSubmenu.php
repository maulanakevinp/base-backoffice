<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSubmenu extends Model
{
    protected $table = 'menu_submenu';
    protected $guarded = [];

    public function judul_menu_menu()
    {
        return $this->belongsTo(JudulMenuMenu::class);
    }

    public function submenu()
    {
        return $this->belongsTo(Submenu::class);
    }

    public function submenu_sub_submenu()
    {
        return $this->hasMany(SubmenuSubSubmenu::class);
    }
}
