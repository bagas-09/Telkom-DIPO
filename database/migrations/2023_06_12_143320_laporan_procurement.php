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
            $table->string("PR_SAP");
            $table->integer('PO_SAP');
            $table->date('tanggal_PO_SAP');
            $table->integer('material_DRM_TA');
            $table->integer('jasa_DRM_TA');
            $table->integer('total_DRM_TA');
            $table->integer('material_aktual');
            $table->integer('jasa_aktual');
            $table->integer('total_aktual');
            $table->unsignedBigInteger('status_tagihan_id');
            $table->foreign('status_tagihan_id')->references('id')->on('status_tagihan');
            $table->string('keterangan');
            $table->string('PID_konstruksi_id');
            $table->foreign('PID_konstruksi_id')->references('PID_konstruksi')->on('laporan_konstruksi');
            $table->string('PID_maintenance_id');
            $table->foreign('PID_maintenance_id')->references('PID_maintenance')->on('laporan_maintenance');
            $table->string('lokasi');
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
