<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaporanCommerce extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('laporan_commerce', function (Blueprint $table) {
            $table->id("no_PO");
            $table->date('tanggal_PO');
            $table->string('No_SP');
            $table->date('tanggal_SP');
            $table->string('TOC');
            $table->string('No_BAUT');
            $table->date('tanggal_BAUT');
            $table->string('NO_BAR');
            $table->date('tanggal_BAR');
            $table->string('NO-BAST');
            $table->date('tanggal_BAST');
            $table->integer('material_aktual');
            $table->integer('jasa_aktual');
            $table->integer('total_aktual');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status');
            $table->string('PID_konstruksi_id')->nullable();
            $table->foreign('PID_konstruksi_id')->references('PID_konstruksi')->on('laporan_konstruksi');
            $table->string('PID_maintenance_id')->nullable();
            $table->foreign('PID_maintenance_id')->references('PID_maintenance')->on('laporan_maintenance');
            $table->string('lokasi');
            $table->integer("draft")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('laporan_commerce');
        
    }
}
