<?php

namespace Database\Seeders;

use App\Models\DetailKontak;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailKontakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DetailKontak::truncate();
        DetailKontak::create(['data_pribadi_id' => 1]);
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
    }
}
