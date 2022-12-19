<?php

namespace App\Http\Middleware;

use App\Models\PeranJudulMenu;
use Closure;

class Peran
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        foreach (PeranJudulMenu::where('peran_id', auth()->user()->peran_id)->get() as $peran_judul_menu) {
            foreach ($peran_judul_menu->judul_menu_menu as $judul_menu_menu) {
                if ($judul_menu_menu->menu->url == request()->segment(1)) {
                    return $next($request);
                }
                foreach ($judul_menu_menu->menu_submenu as $menu_submenu) {
                    if ($menu_submenu->submenu->url == request()->segment(1)) {
                        return $next($request);
                    }
                    foreach ($menu_submenu->submenu_sub_submenu as $submenu_sub_submenu) {
                        if ($submenu_sub_submenu->sub_submenu->url == request()->segment(1)) {
                            return $next($request);
                        }
                    }
                }
            }
        }

        return abort(403);
    }
}
