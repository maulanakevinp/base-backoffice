<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        Menu::truncate();
        DB::statement("INSERT INTO menu (id, judul_menu_id, urutan, nama, icon, url) VALUES
        (1, 1, 1, 'Admin', 'fas fa-user-cog', '#');");
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
    }
}
