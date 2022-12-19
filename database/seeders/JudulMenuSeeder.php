<?php

namespace Database\Seeders;

use App\Models\JudulMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JudulMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        JudulMenu::truncate();
        JudulMenu::create([
            'urutan'=> 1,
            'nama'  => 'Menu',
        ]);
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }
}
