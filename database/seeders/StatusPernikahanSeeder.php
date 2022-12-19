<?php

namespace Database\Seeders;

use App\Models\StatusPernikahan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusPernikahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        StatusPernikahan::truncate();
        StatusPernikahan::create(['nama' => 'Belum Menikah']);
        StatusPernikahan::create(['nama' => 'Menikah']);
        StatusPernikahan::create(['nama' => 'Lainnya']);
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
    }
}
