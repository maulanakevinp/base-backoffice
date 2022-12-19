<?php

namespace Database\Seeders;

use App\Models\DataPribadi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataPribadiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DataPribadi::truncate();
        DataPribadi::create([
            'nama'                  => 'Super Admin',
            'jenis_kelamin_id'      => 1,
            'status_pernikahan_id'  => 1,
        ]);
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }
}
