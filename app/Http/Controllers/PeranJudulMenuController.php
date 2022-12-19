<?php

namespace App\Http\Controllers;

use App\Models\PeranJudulMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeranJudulMenuController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $peran_judul_menu = PeranJudulMenu::create($request->all());
        activity()->log('Mengaktifkan Judul Menu ' . $peran_judul_menu->judul_menu->nama . ' Untuk Peran ' . $peran_judul_menu->peran->nama);
        return back()->with('success', 'Judul menu ' . $peran_judul_menu->judul_menu->nama . ' berhasil diaktifkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PeranJudulMenu  $peran_judul_menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeranJudulMenu $peran_judul_menu)
    {
        foreach ($peran_judul_menu->judul_menu_menu as $judul_menu_menu) {
            foreach ($judul_menu_menu->menu_submenu as $menu_submenu) {
                foreach ($menu_submenu->submenu_sub_submenu as $submenu_sub_submenu) {
                    $submenu_sub_submenu->delete();
                }
                $menu_submenu->delete();
            }
            $judul_menu_menu->delete();
        }
        $peran_judul_menu->delete();
        activity()->log('Menonaktifkan Judul Menu ' . $peran_judul_menu->judul_menu->nama . ' Untuk Peran ' . $peran_judul_menu->peran->nama);
        return back()->with('success', 'Judul menu ' . $peran_judul_menu->judul_menu->nama . ' berhasil dinonaktifkan');
    }
}
