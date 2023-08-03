<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaporanProcurement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('laporan_procurement', function (Blueprint $table) {
            $table->string("PR_SAP")->primary();
            $table->integer('PO_SAP')->nullable();
            $table->date('tanggal_PO_SAP')->nullable();
            $table->string('material_DRM')->nullable();
            $table->string('jasa_DRM')->nullable();
            $table->string('total_DRM')->nullable();
            $table->string('material_aktual')->nullable();
            $table->string('jasa_aktual')->nullable();
            $table->string('total_aktual')->nullable();
            $table->unsignedBigInteger('status_tagihan_id')->nullable();
            $table->foreign('status_tagihan_id')->references('id')->on('status_tagihan');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('laporan_procurement');
    }
}
