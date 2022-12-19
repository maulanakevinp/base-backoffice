<?php

namespace App\Http\Controllers;

use App\Models\DataPribadi;
use Illuminate\Http\Request;

class DataPribadiController extends Controller
{
    public function update(Request $request, DataPribadi $data_pribadi)
    {
        $data = $request->validate([
            'nama'                  => ['required','string','max:64'],
            'avatar'                => ['nullable','image','max:2048'],
            'tanggal_lahir'         => ['nullable','date','before:now'],
            'jenis_kelamin_id'      => ['nullable','numeric'],
            'status_pernikahan_id'  => ['nullable','numeric'],
            'nik'                   => ['nullable','string','digits:16'],
            'nama_panggilan'        => ['nullable','string','max:32'],
        ],[
            'jenis_kelamin_id.required'     => 'jenis kelamin wajib diisi.',
            'status_pernikahan_id.required' => 'status pernikahan wajib diisi.',
            'nik.digits:16'                 => 'Nomor KTP harus 16 digit.',
        ]);

        $data_lama = $data_pribadi->toArray();
        unset($data_lama['id'],$data_lama['created_at'],$data_lama['updated_at']);
        activity()->withProperties(['attributes' => $data, 'old' => $data_lama])->log('Memperbarui Data Pribadi');

        $data_pribadi->update($data);

        return response()->json([
            'success'   => true,
            'message'   => 'Data Pribadi berhasil diperbarui',
            'reload'    => true
        ]);
    }
}
