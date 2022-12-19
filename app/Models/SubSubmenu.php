<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSubmenu extends Model
{
    protected $table = "sub_submenu";
    protected $guarded = [];
    public $timestamps = false;

    public function submenu()
    {
        return $this->belongsTo(Submenu::class);
    }

    public function submenu_sub_submenu()
    {
        return $this->hasMany(SubmenuSubSubmenu::class);
    }
}
