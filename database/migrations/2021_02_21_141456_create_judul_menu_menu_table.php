<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJudulMenuMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('judul_menu_menu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peran_judul_menu_id')->constrained('peran_judul_menu')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('menu_id')->constrained('menu')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('judul_menu_menu');
    }
}
