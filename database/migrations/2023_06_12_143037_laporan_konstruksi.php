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
            $table->string('ID_SAP_konstruksi')->primary()->nullable();
            $table->string("PID_konstruksi")->nullable();
            $table->string('NO_PR_konstruksi')->nullable();
            $table->date('tanggal_PR')->nullable();
            $table->unsignedBigInteger('status_pekerjaan_id')->nullable();
            $table->foreign('status_pekerjaan_id')->references('id')->on('status_pekerjaan');
            $table->unsignedBigInteger('mitra_id')->nullable();
            $table->foreign('mitra_id')->references('id')->on('mitra');
            $table->unsignedBigInteger('tipe_kemitraan_id')->nullable();
            $table->foreign('tipe_kemitraan_id')->references('id')->on('tipe_kemitraan');
            $table->unsignedBigInteger('program_id')->nullable();
            $table->foreign('program_id')->references('id')->on('program');
            $table->unsignedBigInteger('tipe_provisioning_id')->nullable();
            $table->foreign('tipe_provisioning_id')->references('id')->on('tipe_provisioning');
            $table->unsignedBigInteger('kota_id');
            $table->foreign('kota_id')->references('id')->on('city');
            $table->string('lokasi')->nullable();
            $table->string('material_DRM')->nullable();
            $table->string('jasa_DRM')->nullable();
            $table->string('total_DRM')->nullable();
            $table->string('material_aktual')->nullable();
            $table->string('jasa_aktual')->nullable();
            $table->string('total_aktual')->nullable();
            $table->string('keterangan')->nullable();
            $table->string("slugk")->unique();
            $table->integer("commerce")->nullable();
            $table->integer("procurement")->nullable();
            $table->boolean('editable')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer("draft")->nullable();
            $table->timestamp('tanggal')->nullable();
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