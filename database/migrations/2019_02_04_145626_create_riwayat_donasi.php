<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiwayatDonasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_donasi', function (Blueprint $table) {
            $table->string('riwa_id')->unique();
            $table->date('riwa_tanggal');
            $table->string('riwa_penerima');
            $table->string('riwa_domisili');
            $table->string('riwa_pemberi');
            $table->string('riwa_asal');
            $table->unsignedBigInteger('riwa_jml');
            $table->string('riwa_jenis');
            $table->string('riwa_bank')->nullable();
            $table->bigInteger('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_donasi');
    }
}
