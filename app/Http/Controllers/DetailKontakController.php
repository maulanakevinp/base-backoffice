<?php

namespace App\Http\Controllers;

use App\Models\DetailKontak;
use Illuminate\Http\Request;

class DetailKontakController extends Controller
{
    public function update(Request $request, DetailKontak $detail_kontak)
    {
        $data = $request->validate([
            'alamat'            => ['nullable'],
            'kota'              => ['nullable','string','max:128'],
            'provinsi'          => ['nullable','string','max:128'],
            'kode_pos'          => ['nullable','string','max:8','regex:/^([0-9]*)$/'],
            'telepon_rumah'     => ['nullable','string','max:21','regex:/^([0-9\s\+\-\(\)]*)$/'],
            'telepon_seluler'   => ['nullable','string','max:21','regex:/^([0-9\s\+\-\(\)]*)$/'],
            'telepon_kerja'     => ['nullable','string','max:21','regex:/^([0-9\s\+\-\(\)]*)$/'],
            'email_kerja'       => ['nullable','email','max:64'],
            'email_lain'        => ['nullable','email','max:64'],
        ]);

        $data_lama = $detail_kontak->toArray();
        unset($data_lama['id'],$data_lama['created_at'],$data_lama['updated_at']);
        activity()->withProperties(['attributes' => $data, 'old' => $data_lama])->log('Memperbarui Data Detail Kontak');

        $detail_kontak->update($data);

        return response()->json([
            'success'   => true,
            'message'   => 'Detail kontak berhasil diperbarui',
            'reload'    => true
        ]);
    }
}
