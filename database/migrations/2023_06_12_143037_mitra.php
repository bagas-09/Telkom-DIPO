<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mitra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        {
            //
            Schema::create('mitra', function (Blueprint $table) {
                $table->id();
                $table->string('nama_mitra');
                $table->string('role');
                $table->foreign('role')->references('nama_role')->on('role');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('mitra');
    }
}
