<?php

namespace Database\Seeders;

use App\Models\Submenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        Submenu::truncate();
        DB::statement("INSERT INTO submenu (id, menu_id, urutan, nama, url) VALUES
        (1, 1, 1, 'Kelola Pengguna', '#'),
        (2, 1, 2, 'Organisasi', '#'),
        (3, 1, 3, 'Database', 'database'),
        (4, 1, 4, 'Kelola Menu', 'menu');");
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
    }
}
