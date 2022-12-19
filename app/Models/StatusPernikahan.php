<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPernikahan extends Model
{
    protected $table = 'status_pernikahan';
    protected $guarded = [];
    public $timestamps = false;

    public function user_detail()
    {
        return $this->hasMany(UserDetail::class);
    }
}
