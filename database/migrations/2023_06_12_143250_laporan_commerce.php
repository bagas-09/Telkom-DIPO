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
            $table->string('no_PO')->primary();
            $table->date('tanggal_PO')->nullable();
            $table->string('No_SP')->nullable();
            $table->date('tanggal_SP')->nullable();
            $table->date('TOC')->nullable();
            $table->string('No_BAUT')->nullable();
            $table->date('tanggal_BAUT')->nullable();
            $table->string('NO_BAR')->nullable();
            $table->date('tanggal_BAR')->nullable();
            $table->string('NO_BAST')->nullable();
            $table->date('tanggal_BAST')->nullable();
            $table->string('material_aktual')->nullable();
            $table->string('jasa_aktual')->nullable();
            $table->string('total_aktual')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('status');
            $table->string('PID_konstruksi_id')->nullable();
            $table->foreign('PID_konstruksi_id')->references('PID_konstruksi')->on('laporan_konstruksi');
            $table->string('PID_maintenance_id')->nullable();
            $table->foreign('PID_maintenance_id')->references('PID_maintenance')->on('laporan_maintenance');
            $table->unsignedBigInteger('kota_id');
            $table->foreign('kota_id')->references('id')->on('city');
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
