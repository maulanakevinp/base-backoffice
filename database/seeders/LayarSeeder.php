<?php

namespace Database\Seeders;

use App\Models\Layar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        Layar::truncate();
        Layar::create(['nama' => 'Detail Kontak']);
        Layar::create(['nama' => 'Data Pribadi']);
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
    }
}
