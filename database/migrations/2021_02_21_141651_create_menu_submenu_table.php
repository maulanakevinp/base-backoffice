<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuSubmenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_submenu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('judul_menu_menu_id')->constrained('judul_menu_menu')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('submenu_id')->constrained('submenu')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('menu_submenu');
    }
}
