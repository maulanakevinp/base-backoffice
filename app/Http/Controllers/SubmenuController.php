<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($menu_id)
    {
        $menu = Menu::find($menu_id);
        if (request()->ajax()) {
            return datatables()->of(Submenu::select('id','nama','url','urutan')->where('menu_id',$menu_id))
                ->addColumn('edit', function ($data) {
                    $html = '<a href="#" class="ubah-submenu mx-3" title="Ubah" data-id="'. $data->id .'"><i class="fas fa-edit"></i></a>';
                    $html .= '<a href="'. route('sub-submenu.index', $data->id) .'" title="Ubah Sub Submenu" data-id="'. $data->id .'"><i class="fas fa-bars"></i></a>';
                    if ($data->urutan != 1) {
                        $html .= '<a href="#" class="mx-3 atas" data-id="'. $data->id .'" data-toggle="tooltip" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></a>';
                    }

                    if ($data->urutan != Submenu::orderBy('urutan','desc')->first()->urutan) {
                        $html .= '<a href="#" class="mx-3 bawah" data-id="'. $data->id .'" data-toggle="tooltip" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></a>';
                    }
                    return $html;
                })
                ->addColumn('check', function ($data) {
                    return '<input type="checkbox" class="check-submenu" value="'. $data->id .'">';
                })
                ->rawColumns(['check', 'edit'])
                ->make(true);
        }
        activity()->log('Melihat Data Submenu');
        return view('submenu.index', compact('menu'));
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
            'menu_id'   => ['required',],
            'nama'      => ['required', 'string', 'max:128', 'unique:submenu,nama'],
            'url'       => ['nullable', 'string', 'max:128'],
        ]);

        $data['url']            = str_replace(' ','',($request->url ?? '#') );
        $data['urutan']         = Submenu::orderBy('urutan','desc')->first()->urutan + 1;
        Submenu::create($data);
        activity()->log('Menambah Data Submenu');
        return response()->json([
            'success'   => true,
            'message'   => 'Submenu berhasil ditambahkan',
            'reload'    => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Submenu  $submenu
     * @return \Illuminate\Http\Response
     */
    public function show(Submenu $submenu)
    {
        activity()->log('Melihat Data Submenu');
        return response()->json([
            'success'       => true,
            'data'          => $submenu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Submenu  $submenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Submenu $submenu)
    {
        $data = $request->validate([
            'nama'  => ['required', 'string', 'max:128', 'unique:submenu,nama,'. $submenu->id],
            'url'       => ['nullable', 'string', 'max:128'],
        ]);

        $data_lama = $submenu->toArray();
        unset($data_lama['id'],$data_lama['created_at'],$data_lama['updated_at']);
        activity()->withProperties(['attributes' => $data, 'old' => $data_lama])->log('Memperbarui Data Submenu');

        $submenu->update($data);
        return response()->json([
            'success'   => true,
            'message'   => 'Submenu berhasil diperbarui',
            'reload'    => true
        ]);
    }

    public function urutan(Request $request)
    {
        $request->validate([
            'urutan'    => ['required'],
            'id'        => ['required']
        ]);

        $submenu1 = Submenu::findOrFail($request->id);

        if ($request->urutan == 'atas') {
            $submenu2 = Submenu::where('urutan', $submenu1->urutan - 1)->first();
            $submenu1->urutan = $submenu1->urutan - 1;
            $submenu2->urutan = $submenu2->urutan + 1;
            $submenu1->save();
            $submenu2->save();
            return response()->json([
                'success'   => true,
                'message'   => 'Urutan berhasil dipindahkan'
            ]);
        } elseif ($request->urutan == 'bawah') {
            $submenu2 = Submenu::where('urutan', $submenu1->urutan + 1)->first();
            $submenu1->urutan = $submenu1->urutan + 1;
            $submenu2->urutan = $submenu2->urutan - 1;
            $submenu1->save();
            $submenu2->save();
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
            $submenu = Submenu::find($id);
            $submenu->delete();
        }

        activity()->log('Menghapus Data Submenu');
        return response()->json([
            'success'   => true,
            'message'   => 'Submenu berhasil dihapus',
        ]);
    }
}
