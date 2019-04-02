<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->string('lap_id')->unique();
            $table->date('lap_tanggal');
            $table->string('lap_kegiatan');
            $table->string('lap_penerima')->nullable();
            $table->string('lap_domisili')->nullable();
            $table->string('lap_pemberi')->nullable();
            $table->string('lap_asal')->nullable();
            $table->unsignedBigInteger('lap_jml');
            $table->string('lap_jenis');
            $table->string('lap_bank')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan');
    }
}
