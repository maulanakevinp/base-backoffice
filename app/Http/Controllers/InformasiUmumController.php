<?php

namespace App\Http\Controllers;

use App\Models\InformasiUmum;
use Illuminate\Http\Request;

class InformasiUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        activity()->log('Melihat Data Informasi Umum');
        return view('informasi-umum.index',['informasi_umum' => InformasiUmum::find(1)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InformasiUmum  $informasi_umum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InformasiUmum $informasi_umum)
    {
        $data = $request->validate([
            'nama_organisasi'                   => ['required','string','max:128'],
            'tax_id'                            => ['nullable'],
            'nomor_registrasi'                  => ['nullable'],
            'telepon'                           => ['nullable','string','max:21','regex:/^([0-9\s\+\-\(\)]*)$/'],
            'fax'                               => ['nullable','string','max:21','regex:/^([0-9\s\+\-\(\)]*)$/'],
            'whatsapp'                          => ['nullable','string','max:21','regex:/^([0-9\s\+\-\(\)]*)$/'],
            'email'                             => ['nullable','email','max:64'],
            'alamat'                            => ['nullable','string','max:128'],
            'kota'                              => ['nullable','string','max:128'],
            'provinsi'                          => ['nullable','string','max:128'],
            'kode_pos'                          => ['nullable','string','max:8','regex:/^([0-9\s]*)$/'],
            'kode_negara'                       => ['nullable','string','max:2'],
            'tentang_kami'                      => ['nullable'],
            'website'                           => ['nullable','string','max:64'],
            'link_facebook'                     => ['nullable'],
            'link_instagram'                    => ['nullable'],
            'link_youtube'                      => ['nullable'],
            'link_twitter'                      => ['nullable'],
            'link_maps'                         => ['nullable'],
            'video'                             => ['nullable'],
        ]);

        $data_lama = $informasi_umum->toArray();
        unset($data_lama['id'],$data_lama['created_at'],$data_lama['updated_at']);
        activity()->withProperties(['attributes' => $data, 'old' => $data_lama])->log('Memperbarui Data Informasi Umum');

        $informasi_umum->update($data);

        return response()->json([
            'success'   => true,
            'message'   => 'Informasi umum berhasil diperbarui',
            'redirect'  => route('informasi-umum.index')
        ]);
    }
}
