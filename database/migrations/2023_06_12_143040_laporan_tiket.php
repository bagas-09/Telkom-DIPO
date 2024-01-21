<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaporanTiket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('laporan_tiket', function (Blueprint $table) {
            $table->string("ID_tiket")->primary();
            $table->string('ID_SAP_maintenance')->nullable();
            $table->foreign('ID_SAP_maintenance')->references('ID_SAP_maintenance')->on('laporan_maintenance');
            $table->string('datek')->nullable();
            $table->unsignedBigInteger('status_pekerjaan_id')->nullable();
            $table->foreign('status_pekerjaan_id')->references('id')->on('status_pekerjaan');
            $table->unsignedBigInteger('mitra_id')->nullable();
            $table->foreign('mitra_id')->references('id')->on('mitra');
            $table->unsignedBigInteger('tipe_kemitraan_id')->nullable();
            $table->foreign('tipe_kemitraan_id')->references('id')->on('tipe_kemitraan');
            $table->unsignedBigInteger('jenis_program_id')->nullable();
            $table->foreign('jenis_program_id')->references('id')->on('jenis_program');
            $table->unsignedBigInteger('tipe_provisioning_id')->nullable();
            $table->foreign('tipe_provisioning_id')->references('id')->on('tipe_provisioning');
            $table->unsignedBigInteger('kota_id');
            $table->foreign('kota_id')->references('id')->on('city');
            $table->string('periode_pekerjaan')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('material_DRM')->nullable();
            $table->string('jasa_DRM')->nullable();
            $table->string('total_DRM')->nullable();
            $table->string('material_aktual')->nullable();
            $table->string('jasa_aktual')->nullable();
            $table->string('total_aktual')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer("commerce")->nullable();
            $table->integer("procurement")->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->boolean('editable')->default(0);
            $table->timestamp('tanggal')->nullable();
            $table->string("slugt")->unique();
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
        Schema::dropIfExists('laporan_tiket');
    }
}
