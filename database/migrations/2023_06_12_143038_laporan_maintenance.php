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
            $table->string('ID_SAP_maintenance')->primary()->onDelete('cascade');
            $table->string("PID_maintenance");
            $table->string('NO_PR_maintenance');
            $table->date('tanggal_PR');
            $table->string('keterangan')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->boolean('editable')->default(0);
            $table->integer("draft")->nullable();
            $table->unsignedBigInteger('kota_id');
            $table->foreign('kota_id')->references('id')->on('city');
            $table->timestamp('tanggal')->nullable();
            $table->string("slugm")->unique()->onDelete('cascade');
            
            
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
