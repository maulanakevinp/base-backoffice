<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformasiUmumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informasi_umum', function (Blueprint $table) {
            $table->id();
            $table->string('nama_organisasi',128);
            $table->string('tax_id',16)->nullable();
            $table->string('nomor_registrasi',16)->nullable();
            $table->string('telepon',21)->nullable();
            $table->string('fax',21)->nullable();
            $table->string('email',64)->nullable();
            $table->string('alamat',128)->nullable();
            $table->string('whatsapp',128)->nullable();
            $table->string('kota',128)->nullable();
            $table->string('provinsi',128)->nullable();
            $table->string('kode_pos',8)->nullable();
            $table->text('tentang_kami')->nullable();
            $table->string('channel_id', 64)->nullable();
            $table->string('website',64)->nullable();
            $table->text('link_facebook')->nullable();
            $table->text('link_instagram')->nullable();
            $table->text('link_youtube')->nullable();
            $table->text('link_twitter')->nullable();
            $table->text('link_maps')->nullable();
            $table->text('video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informasi_umum');
    }
}
