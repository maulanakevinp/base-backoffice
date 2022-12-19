<?php

namespace Database\Seeders;

use App\Models\PeranJudulMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeranJudulMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        PeranJudulMenu::truncate();
        DB::statement("INSERT INTO peran_judul_menu (id, peran_id, judul_menu_id, created_at, updated_at) VALUES
        (1, 1, 1, '2021-05-18 09:01:11', '2021-05-18 09:01:11');");
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
    }
}
