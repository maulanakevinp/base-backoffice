<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PeranSeeder::class);
        $this->call(JudulMenuSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(SubmenuSeeder::class);
        $this->call(SubSubmenuSeeder::class);
        $this->call(PeranJudulMenuSeeder::class);
        $this->call(JudulMenuMenuSeeder::class);
        $this->call(MenuSubmenuSeeder::class);
        $this->call(SubmenuSubSubmenuSeeder::class);
    }
}
