<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonatur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donatur', function (Blueprint $table) {
            $table->bigInteger('dona_id')->unique();
            $table->string('dona_nama');
            $table->string('dona_tempat_lahir')->nullable();
            $table->date('dona_tgl_lahir')->nullable();
            $table->string('dona_alamat')->nullable();
            $table->string('dona_rt')->nullable();
            $table->string('dona_rw')->nullable();
            $table->string('dona_kodepos')->nullable();
            $table->string('dona_kelurahan')->nullable();
            $table->string('dona_kecamatan')->nullable();
            $table->string('dona_kota_kab');
            $table->string('dona_provinsi');
            $table->string('dona_negara');
            $table->string('dona_no_telp')->nullable();
            $table->string('dona_no_hp')->nullable();
            $table->string('dona_email')->nullable();
            $table->string('dona_akun_facebook')->nullable();
            $table->string('dona_akun_instagram')->nullable();
            $table->string('dona_profesi')->nullable();
            $table->string('dona_catatan', 255)->nullable();
            $table->integer('fund_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donatur');
    }
}
