<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPribadiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pribadi', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 64);
            $table->string('avatar',64)->default('public/noavatar.png');
            $table->date('tanggal_lahir')->nullable();
            $table->unsignedBigInteger('jenis_kelamin_id')->nullable();
            $table->foreign('jenis_kelamin_id')->on('jenis_kelamin')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('status_pernikahan_id')->nullable();
            $table->foreign('status_pernikahan_id')->on('status_pernikahan')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nik', 16)->nullable();
            $table->string('nama_panggilan',32)->nullable();
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
        Schema::dropIfExists('data_pribadi');
    }
}
