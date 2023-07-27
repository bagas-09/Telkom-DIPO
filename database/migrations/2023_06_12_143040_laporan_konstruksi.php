<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaporanKonstruksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('laporan_konstruksi', function (Blueprint $table) {
            $table->string("PID_konstruksi")->primary();
            $table->string('ID_SAP_konstruksi');
            $table->string('NO_PR_konstruksi');
            $table->date('tanggal_PR');
            $table->unsignedBigInteger('status_pekerjaan_id');
            $table->foreign('status_pekerjaan_id')->references('id')->on('status_pekerjaan');
            $table->unsignedBigInteger('mitra_id');
            $table->foreign('mitra_id')->references('id')->on('mitra');
            $table->unsignedBigInteger('tipe_kemitraan_id');
            $table->foreign('tipe_kemitraan_id')->references('id')->on('tipe_kemitraan');
            $table->unsignedBigInteger('jenis_order_id');
            $table->foreign('jenis_order_id')->references('id')->on('jenis_order');
            $table->unsignedBigInteger('tipe_provisioning_id');
            $table->foreign('tipe_provisioning_id')->references('id')->on('tipe_provisioning');
            $table->string('lokasi');
            $table->string('material_DRM');
            $table->string('jasa_DRM');
            $table->string('total_DRM');
            $table->string('material_aktual');
            $table->string('jasa_aktual');
            $table->string('total_aktual');
            $table->string('keterangan');
            $table->integer("commerce")->nullable();
            $table->boolean('editable')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('laporan_konstruksi');
        
        
    }
}