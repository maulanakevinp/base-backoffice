<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailKontakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_kontak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_pribadi_id')->constrained('data_pribadi')->onUpdate('cascade')->onDelete('cascade');
            $table->text('alamat')->nullable();
            $table->string('kota', 128)->nullable();
            $table->string('provinsi', 128)->nullable();
            $table->string('kode_pos', 8)->nullable();
            $table->string('telepon_rumah', 21)->nullable();
            $table->string('telepon_seluler', 21)->nullable();
            $table->string('telepon_kerja', 21)->nullable();
            $table->string('email_kerja', 64)->nullable();
            $table->string('email_lain', 64)->nullable();
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
        Schema::dropIfExists('detail_kontak');
    }
}
