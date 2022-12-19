<?php

namespace App\Http\Controllers;

use App\Models\Submenu;
use App\Models\SubSubmenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubSubmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($submenu_id)
    {
        $submenu = Submenu::find($submenu_id);
        if (request()->ajax()) {
            return datatables()->of(SubSubmenu::select('id','nama','url','urutan')->where('submenu_id',$submenu_id))
                ->addColumn('edit', function ($data) {
                    $html = '<a href="#" class="ubah-sub-submenu mx-3" title="Ubah" data-id="'. $data->id .'"><i class="fas fa-edit"></i></a>';
                    if ($data->urutan != 1) {
                        $html .= '<a href="#" class="mx-3 atas" data-id="'. $data->id .'" data-toggle="tooltip" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></a>';
                    }

                    if ($data->urutan != SubSubmenu::orderBy('urutan','desc')->first()->urutan) {
                        $html .= '<a href="#" class="mx-3 bawah" data-id="'. $data->id .'" data-toggle="tooltip" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></a>';
                    }
                    return $html;
                })
                ->addColumn('check', function ($data) {
                    return '<input type="checkbox" class="check-sub-submenu" value="'. $data->id .'">';
                })
                ->rawColumns(['check', 'edit'])
                ->make(true);
        }
        activity()->log('Melihat Data Sub Submenu');
        return view('sub-submenu.index', compact('submenu'));
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
            'submenu_id'=> ['required',],
            'nama'      => ['required', 'string', 'max:128', 'unique:sub_submenu,nama'],
            'url'       => ['nullable', 'string', 'max:128'],
        ]);

        $data['url']            = str_replace(' ','',($request->url ?? '#') );
        $data['urutan']         = SubSubmenu::orderBy('urutan','desc')->first()->urutan + 1;
        SubSubmenu::create($data);
        activity()->log('Menambah Data Sub Submenu');
        return response()->json([
            'success'   => true,
            'message'   => 'Sub Submenu berhasil ditambahkan',
            'reload'    => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubSubmenu  $sub_submenu
     * @return \Illuminate\Http\Response
     */
    public function show(SubSubmenu $sub_submenu)
    {
        activity()->log('Melihat Data Sub Submenu');
        return response()->json([
            'success'       => true,
            'data'          => $sub_submenu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubSubmenu  $sub_submenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubSubmenu $sub_submenu)
    {
        $data = $request->validate([
            'nama'  => ['required', 'string', 'max:128', 'unique:sub_submenu,nama,'. $sub_submenu->id],
            'url'       => ['nullable', 'string', 'max:128'],
        ]);

        $data_lama = $sub_submenu->toArray();
        unset($data_lama['id'],$data_lama['created_at'],$data_lama['updated_at']);
        activity()->withProperties(['attributes' => $data, 'old' => $data_lama])->log('Memperbarui Data Sub Submenu');

        $sub_submenu->update($data);
        return response()->json([
            'success'   => true,
            'message'   => 'Sub Submenu berhasil diperbarui',
            'reload'    => true
        ]);
    }

    public function urutan(Request $request)
    {
        $request->validate([
            'urutan'    => ['required'],
            'id'        => ['required']
        ]);

        $sub_submenu1 = SubSubmenu::findOrFail($request->id);

        if ($request->urutan == 'atas') {
            $sub_submenu2 = SubSubmenu::where('urutan', $sub_submenu1->urutan - 1)->first();
            $sub_submenu1->urutan = $sub_submenu1->urutan - 1;
            $sub_submenu2->urutan = $sub_submenu2->urutan + 1;
            $sub_submenu1->save();
            $sub_submenu2->save();
            return response()->json([
                'success'   => true,
                'message'   => 'Urutan berhasil dipindahkan'
            ]);
        } elseif ($request->urutan == 'bawah') {
            $sub_submenu2 = SubSubmenu::where('urutan', $sub_submenu1->urutan + 1)->first();
            $sub_submenu1->urutan = $sub_submenu1->urutan + 1;
            $sub_submenu2->urutan = $sub_submenu2->urutan - 1;
            $sub_submenu1->save();
            $sub_submenu2->save();
            return response()->json([
                'success'   => true,
                'message'   => 'Urutan berhasil dipindahkan'
            ]);
        } else {
            return response()->json([
                'success'   => false,
                'message'   => 'Urutan gagal dipindahkan'
            ]);
        }
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
            $sub_submenu = SubSubmenu::find($id);
            $sub_submenu->delete();
        }

        activity()->log('Menghapus Data Sub Submenu');
        return response()->json([
            'success'   => true,
            'message'   => 'Sub Submenu berhasil dihapus',
        ]);
    }
}
