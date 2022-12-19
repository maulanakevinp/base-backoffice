<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPribadi extends Model
{
    protected $table = 'data_pribadi';
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function detail_kontak()
    {
        return $this->hasOne(DetailKontak::class);
    }

    public function lampiran()
    {
        return $this->hasMany(Lampiran::class);
    }

    public function jenis_kelamin()
    {
        return $this->belongsTo(JenisKelamin::class);
    }

    public function status_pernikahan()
    {
        return $this->belongsTo(StatusPernikahan::class);
    }

    public function user_kustom_bidang()
    {
        return $this->hasMany(UserKustomBidang::class);
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class);
    }

    public function pelatihan_karyawan()
    {
        return $this->hasMany(PelatihanKaryawan::class);
    }
}
