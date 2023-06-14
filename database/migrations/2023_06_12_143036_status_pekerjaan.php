<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StatusPekerjaan extends Migration
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
            Schema::create('status_pekerjaan', function (Blueprint $table) {
                $table->id();
                $table->string('nama_status_pekerjaan');
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
        Schema::dropIfExists('status_pekerjaan');

        
    }
}
