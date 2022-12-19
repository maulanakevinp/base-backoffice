<?php

namespace App\Http\Controllers;

use App\Models\Peran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Peran::select('id','nama','kunci'))
                ->addColumn('edit', function ($data) {
                    if ($data->kunci == null) {
                        $html =  '<a href="#" data-id="' . $data->id . '" class="kunci-peran" title="Kunci"><i class="fas fa-unlock"></i></a>';
                        $html .=  '<a href="' . route('peran.edit', $data->id) . '" class="ml-3" title="Ubah"><i class="fas fa-edit"></i></a>';
                        return $html;
                    } else {
                        return '<a href="#" data-id="' . $data->id . '" class="kunci-peran" title="Buka Kunci"><i class="fas fa-lock"></i></a>';
                    }
                })
                ->addColumn('check', function ($data) {
                    if ($data->kunci == null) {
                        if ($data->nama != "Super Admin" && $data->nama != "Kepala" && $data->nama != "Operator" && $data->nama != "Bidang Keuangan") {
                            return '<input type="checkbox" class="check-peran" value="'. $data->id .'">';
                        }
                    }
                })
                ->rawColumns(['check', 'edit'])
                ->make(true);
        }
        activity()->log('Melihat Data Peran');
        return view('peran.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'  => ['required', 'string', 'max:128', 'unique:peran,nama']
        ]);

        Peran::create($data);
        activity()->log('Menambah Data Peran');
        return response()->json([
            'success'   => true,
            'message'   => 'Peran berhasil ditambahkan',
            'redirect'  => route('peran.index')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peran  $peran
     * @return \Illuminate\Http\Response
     */
    public function edit(Peran $peran)
    {
        if ($peran->kunci == 1) {
            return back();
        }
        activity()->log('Melihat Data Peran');
        return view('peran.edit', compact('peran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peran  $peran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peran $peran)
    {
        if ($peran->kunci == 1) {
            return back()->with('error', 'Peran gagal diperbarui');
        }

        $data = $request->validate([
            'nama'  => ['required', 'string', 'max:128', 'unique:peran,nama,'. $peran->id]
        ]);
        if ($peran->nama != "Super Admin" && $peran->nama != "Kepala" && $peran->nama != "Operator" && $peran->nama != "Bidang Keuangan") {
            return back()->with('error', 'Nama Peran Tidak Boleh Diubah');
        }

        $data_lama = $peran->toArray();
        unset($data_lama['id'],$data_lama['created_at'],$data_lama['updated_at']);
        activity()->withProperties(['attributes' => $data, 'old' => $data_lama])->log('Memperbarui Data Peran');

        $peran->update($data);
        return back()->with('success', 'Peran berhasil diperbarui');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peran  $peran
     * @return \Illuminate\Http\Response
     */
    public function update_kunci(Request $request, Peran $peran)
    {
        $peran->kunci = $peran->kunci == 1 ? null : 1;
        $peran->save();
        activity()->log($peran->kunci == 1 ? 'Mengunci Data Peran '. $peran->nama : 'Membuka Data Peran '. $peran->nama);
        return response()->json([
            'success' => true,
            'message' => $peran->kunci == 1 ? 'Peran berhasil dikunci' : 'Peran berhasil dibuka',
            'data'    => $peran
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        foreach ($request->id as $id) {
            $peran = Peran::find($id);
            if ($peran->nama != "Super Admin" && $peran->nama != "Kepala" && $peran->nama != "Operator" && $peran->nama != "Bidang Keuangan") {
                $peran->delete();
            }
        }

        activity()->log('Menghapus Data Peran');
        return response()->json([
            'success'   => true,
            'message'   => 'Peran berhasil dihapus',
        ]);
    }
}
