<?php

namespace Database\Seeders;

use App\Models\Peran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        Peran::truncate();
        DB::statement("INSERT INTO peran (id, nama, kunci, created_at, updated_at) VALUES
        (1, 'Super Admin', TRUE, '2021-05-18 23:01:11', '2021-05-18 23:19:48'),
        (2, 'Pegawai', TRUE, '2021-05-18 23:01:11', '2021-05-18 23:19:48');");
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }
}
