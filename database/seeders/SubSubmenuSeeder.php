<?php

namespace Database\Seeders;

use App\Models\SubSubmenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubSubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        SubSubmenu::truncate();
        DB::statement("INSERT INTO sub_submenu (id, submenu_id, urutan, nama, url) VALUES
        (1, 1, 1, 'Pengguna', 'pengguna'),
        (2, 1, 2, 'Peran', 'peran'),
        (3, 2, 3, 'Informasi Umum', 'informasi-umum');");
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }
}
