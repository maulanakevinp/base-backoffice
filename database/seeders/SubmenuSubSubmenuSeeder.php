<?php

namespace Database\Seeders;

use App\Models\SubmenuSubSubmenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmenuSubSubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        SubmenuSubSubmenu::truncate();
        DB::statement("INSERT INTO submenu_sub_submenu (id, menu_submenu_id, sub_submenu_id, created_at, updated_at) VALUES
        (1, 1, 1, '2021-05-18 16:01:11', '2021-05-18 16:01:11'),
        (2, 1, 2, '2021-05-18 16:01:11', '2021-05-18 16:01:11'),
        (3, 2, 3, '2021-05-18 16:01:11', '2021-05-18 16:01:11');");
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }
}
