<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        User::truncate();
        User::create([
            'username'          => 'admin',
            'email'             => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'peran_id'          => 1,
            'data_pribadi_id'   => 1,
        ]);
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
    }
}
