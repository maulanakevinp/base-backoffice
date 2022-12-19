<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(JenisKelaminSeeder::class);
        $this->call(InformasiUmumSeeder::class);
        $this->call(StatusPernikahanSeeder::class);
        $this->call(PeranSeeder::class);
        $this->call(JudulMenuSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(SubmenuSeeder::class);
        $this->call(SubSubmenuSeeder::class);
        $this->call(PeranJudulMenuSeeder::class);
        $this->call(JudulMenuMenuSeeder::class);
        $this->call(MenuSubmenuSeeder::class);
        $this->call(SubmenuSubSubmenuSeeder::class);
        $this->call(DataPribadiSeeder::class);
        $this->call(DetailKontakSeeder::class);
        $this->call(UserSeeder::class);
    }
}
