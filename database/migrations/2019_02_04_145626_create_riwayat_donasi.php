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
            $table->date('riwa_tanggal')->nullable();
            $table->unsignedBigInteger('riwa_jml')->nullable();
            $table->string('riwa_jenis')->nullable();
            $table->string('riwa_bank')->nullable();
            $table->bigInteger('user_id');
            $table->integer('fund_id');
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
