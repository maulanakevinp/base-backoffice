<?php

namespace Database\Seeders;

use App\Models\MenuSubmenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        MenuSubmenu::truncate();
        DB::statement("INSERT INTO menu_submenu (id, judul_menu_menu_id, submenu_id, created_at, updated_at) VALUES
            (1, 1, 1, '2021-05-18 09:01:11', '2021-05-18 09:01:11'),
            (2, 1, 2, '2021-05-18 09:01:11', '2021-05-18 09:01:11'),
            (3, 1, 3, '2021-05-18 09:01:11', '2021-05-18 09:01:11'),
            (4, 1, 4, '2021-05-18 09:01:11', '2021-05-18 09:01:11')
        ;");
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
    }
}
