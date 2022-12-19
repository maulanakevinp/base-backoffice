<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSubmenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_submenu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submenu_id')->constrained('submenu')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('urutan')->nullable();
            $table->string('nama', 64)->unique();
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
        Schema::dropIfExists('sub_submenu');
    }
}
