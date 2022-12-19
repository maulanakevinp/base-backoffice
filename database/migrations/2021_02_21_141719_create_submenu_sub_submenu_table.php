<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmenuSubSubmenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submenu_sub_submenu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_submenu_id')->constrained('menu_submenu')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('sub_submenu_id')->constrained('sub_submenu')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('submenu_sub_submenu');
    }
}
