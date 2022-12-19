<?php

namespace Database\Seeders;

use App\Models\InformasiUmum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformasiUmumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        InformasiUmum::truncate();
        InformasiUmum::create([
            'nama_organisasi'   => 'Resto',
            'alamat'            => 'Jl. Jawa No.26, Tegal Boto Lor, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
            'website'           => 'https://resto.id',
            'email'             => 'admin@resto.id',
            'link_instagram'    => 'https://www.instagram.com/resto',
            'link_maps'         => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.327713779149!2d113.71311281469129!3d-8.16970138413578!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd69432ce8258d9%3A0xd1d29e9ac16e6caa!2sDinas%20Pemberdayaan%20Masyarakat%20Dan%20Desa%20Kabupaten%20Jember!5e0!3m2!1sid!2sid!4v1630154311195!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'
        ]);
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
    }
}
