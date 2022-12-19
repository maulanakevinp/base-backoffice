<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Menu::select('id','nama','icon','url','urutan'))
                ->addColumn('edit', function ($data) {
                    $html = '<a href="#" class="ubah-menu mx-3" title="Ubah" data-id="'. $data->id .'"><i class="fas fa-edit"></i></a>';
                    $html .= '<a href="'. route('submenu.index', $data->id) .'" title="Ubah Submenu" data-id="'. $data->id .'"><i class="fas fa-bars"></i></a>';
                    if ($data->urutan != 1) {
                        $html .= '<a href="#" class="mx-3 atas" data-id="'. $data->id .'" data-toggle="tooltip" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></a>';
                    }

                    if ($data->urutan != Menu::orderBy('urutan','desc')->first()->urutan) {
                        $html .= '<a href="#" class="mx-3 bawah" data-id="'. $data->id .'" data-toggle="tooltip" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></a>';
                    }
                    return $html;
                })
                ->addColumn('icon', function ($data) {
                    return '<i class="'. $data->icon .'"></i> &nbsp;'. $data->icon;
                })
                ->addColumn('check', function ($data) {
                    return '<input type="checkbox" class="check-menu" value="'. $data->id .'">';
                })
                ->rawColumns(['check', 'icon', 'edit'])
                ->make(true);
        }
        activity()->log('Melihat Data Menu');
        return view('menu.index');
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
            'nama'  => ['required', 'string', 'max:128', 'unique:menu,nama'],
            'icon'  => ['required', 'string', 'max:128'],
            'url'   => ['nullable', 'string', 'max:128'],
        ]);

        $data['url']            = str_replace(' ','',($request->url ?? '#') );
        $data['judul_menu_id']  = 1;
        $data['urutan']         = Menu::orderBy('urutan','desc')->first()->urutan + 1;
        Menu::create($data);
        activity()->log('Menambah Data Menu');
        return response()->json([
            'success'   => true,
            'message'   => 'Menu berhasil ditambahkan',
            'reload'    => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        activity()->log('Melihat Data Menu');
        return response()->json([
            'success'       => true,
            'data'          => $menu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'nama'  => ['required', 'string', 'max:128', 'unique:menu,nama,'. $menu->id],
            'icon'  => ['required', 'string', 'max:128'],
            'url'   => ['nullable', 'string', 'max:128'],
        ]);

        $data_lama = $menu->toArray();
        unset($data_lama['id'],$data_lama['created_at'],$data_lama['updated_at']);
        activity()->withProperties(['attributes' => $data, 'old' => $data_lama])->log('Memperbarui Data Menu');

        $menu->update($data);
        return response()->json([
            'success'   => true,
            'message'   => 'Menu berhasil diperbarui',
            'reload'    => true
        ]);
    }

    public function urutan(Request $request)
    {
        $request->validate([
            'urutan'    => ['required'],
            'id'        => ['required']
        ]);

        $menu1 = Menu::findOrFail($request->id);

        if ($request->urutan == 'atas') {
            $menu2 = Menu::where('urutan', $menu1->urutan - 1)->first();
            $menu1->urutan = $menu1->urutan - 1;
            $menu2->urutan = $menu2->urutan + 1;
            $menu1->save();
            $menu2->save();
            return response()->json([
                'success'   => true,
                'message'   => 'Urutan berhasil dipindahkan'
            ]);
        } elseif ($request->urutan == 'bawah') {
            $menu2 = Menu::where('urutan', $menu1->urutan + 1)->first();
            $menu1->urutan = $menu1->urutan + 1;
            $menu2->urutan = $menu2->urutan - 1;
            $menu1->save();
            $menu2->save();
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
            $menu = Menu::find($id);
            $menu->delete();
        }

        activity()->log('Menghapus Data Menu');
        return response()->json([
            'success'   => true,
            'message'   => 'Menu berhasil dihapus',
        ]);
    }
}
