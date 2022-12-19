<?php

namespace App\Http\Controllers;

use App\Models\SubmenuSubSubmenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubmenuSubSubmenuController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $submenu_sub_submenu = SubmenuSubSubmenu::create($request->all());
        activity()->log('Mengaktifkan Sub Submenu ' . $submenu_sub_submenu->sub_submenu->nama . ' Untuk Peran ' . $submenu_sub_submenu->menu_submenu->judul_menu_menu->peran_judul_menu->peran->nama);
        return back()->with('success', 'Sub submenu ' . $submenu_sub_submenu->sub_submenu->nama . ' berhasil diaktifkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubmenuSubSubmenu  $submenu_sub_submenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubmenuSubSubmenu $submenu_sub_submenu)
    {
        $submenu_sub_submenu->delete();
        activity()->log('Menonaktifkan Sub Submenu ' . $submenu_sub_submenu->sub_submenu->nama . ' Untuk Peran ' . $submenu_sub_submenu->menu_submenu->judul_menu_menu->peran_judul_menu->peran->nama);
        return back()->with('success', 'Sub submenu ' . $submenu_sub_submenu->sub_submenu->nama . ' berhasil dinonaktifkan');
    }
}
