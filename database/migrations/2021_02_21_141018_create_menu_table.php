<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('judul_menu_id')->constrained('judul_menu')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('urutan')->nullable();
            $table->string('nama', 64)->unique();
            $table->string('icon', 64);
            $table->string('url', 128);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
