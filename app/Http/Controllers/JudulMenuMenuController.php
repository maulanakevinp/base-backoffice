<?php

namespace App\Http\Controllers;

use App\Models\JudulMenuMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JudulMenuMenuController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $judul_menu_menu = JudulMenuMenu::create($request->all());
        activity()->log('Mengaktifkan Menu ' . $judul_menu_menu->menu->nama . ' Untuk Peran ' . $judul_menu_menu->peran_judul_menu->peran->nama);
        return back()->with('success', 'Menu ' . $judul_menu_menu->menu->nama . ' berhasil diaktifkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JudulMenuMenu  $judul_menu_menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(JudulMenuMenu $judul_menu_menu)
    {
        foreach ($judul_menu_menu->menu_submenu as $menu_submenu) {
            foreach ($menu_submenu->submenu_sub_submenu as $submenu_sub_submenu) {
                $submenu_sub_submenu->delete();
            }
            $menu_submenu->delete();
        }
        $judul_menu_menu->delete();
        activity()->log('Menonaktifkan Menu ' . $judul_menu_menu->menu->nama . ' Untuk Peran ' . $judul_menu_menu->peran_judul_menu->peran->nama);
        return back()->with('success', 'Menu ' . $judul_menu_menu->menu->nama . ' berhasil dinonaktifkan');
    }
}
