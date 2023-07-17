<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaporanMaintenance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('laporan_maintenance', function (Blueprint $table) {
            $table->string("PID_maintenance")->primary();
            $table->string('ID_SAP_maintenance');
            $table->integer('NO_PR_maintenance');
            $table->date('tanggal_PR');
            $table->unsignedBigInteger('status_pekerjaan_id');
            $table->foreign('status_pekerjaan_id')->references('id')->on('status_pekerjaan');
            $table->unsignedBigInteger('mitra_id');
            $table->foreign('mitra_id')->references('id')->on('mitra');
            $table->unsignedBigInteger('tipe_kemitraan_id');
            $table->foreign('tipe_kemitraan_id')->references('id')->on('tipe_kemitraan');
            $table->unsignedBigInteger('jenis_program_id');
            $table->unsignedBigInteger('tipe_provisioning_id');
            $table->foreign('tipe_provisioning_id')->references('id')->on('tipe_provisioning');
            $table->foreign('jenis_program_id')->references('id')->on('jenis_program');
            $table->date('periode_pekerjaan');
            $table->string('lokasi');
            $table->integer('material_DRM');
            $table->integer('jasa_DRM');
            $table->integer('total_DRM');
            $table->integer('material_aktual');
            $table->integer('jasa_aktual');
            $table->integer('total_aktual');
            $table->string('keterangan');
            $table->integer("commerce")->nullable();
            
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
        Schema::dropIfExists('laporan_maintenance');
    }
}
