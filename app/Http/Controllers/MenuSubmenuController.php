<?php

namespace App\Http\Controllers;

use App\Models\MenuSubmenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuSubmenuController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu_submenu = MenuSubmenu::create($request->all());
        activity()->log('Mengaktifkan Submenu ' . $menu_submenu->submenu->nama . ' Untuk Peran ' . $menu_submenu->judul_menu_menu->peran_judul_menu->peran->nama);
        return back()->with('success', 'Submenu ' . $menu_submenu->submenu->nama . ' berhasil diaktifkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuSubmenu  $menu_submenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuSubmenu $menu_submenu)
    {
        foreach ($menu_submenu->submenu_sub_submenu as $submenu_sub_submenu) {
            $submenu_sub_submenu->delete();
        }
        $menu_submenu->delete();
        activity()->log('Menonaktifkan Submenu ' . $menu_submenu->submenu->nama . ' Untuk Peran ' . $menu_submenu->judul_menu_menu->peran_judul_menu->peran->nama);
        return back()->with('success', 'Submenu ' . $menu_submenu->submenu->nama . ' berhasil dinonaktifkan');
    }
}
