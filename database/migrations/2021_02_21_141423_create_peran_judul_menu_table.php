<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeranJudulMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peran_judul_menu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peran_id')->constrained('peran')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('judul_menu_id')->constrained('judul_menu')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('peran_judul_menu');
    }
}
