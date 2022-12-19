<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmenuSubSubmenu extends Model
{
    protected $table = 'submenu_sub_submenu';
    protected $guarded = [];

    public function menu_submenu()
    {
        return $this->belongsTo(MenuSubmenu::class);
    }

    public function sub_submenu()
    {
        return $this->belongsTo(SubSubmenu::class);
    }
}
