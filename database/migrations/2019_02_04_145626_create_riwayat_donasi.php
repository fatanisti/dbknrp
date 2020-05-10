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
            $table->string('id')->unique();
            $table->date('tanggal');
            $table->string('penerima');
            $table->string('domisili');
            $table->string('pemberi');
            $table->string('asal');
            $table->unsignedBigInteger('jml');
            $table->string('jenis');
            $table->string('bank')->nullable();
            $table->bigInteger('id');
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
