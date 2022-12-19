<?php

namespace Database\Seeders;

use App\Models\JenisKelamin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKelaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        JenisKelamin::truncate();
        JenisKelamin::create(['nama' => 'Laki-laki']);
        JenisKelamin::create(['nama' => 'Perempuan']);
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }
}
