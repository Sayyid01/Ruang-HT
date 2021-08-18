<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainDbHandler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Lokasi Handler
        Schema::create('lokasi', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi');
            $table->string('wilayah');
        });

        Schema::create('alamat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kantor');
            $table->string('alamat');
            $table->foreignId('id_lokasi')->constrained('lokasi')->onUpdate('cascade');
        });

        //HT Handler
        Schema::create('jenis_ht', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_ht');
            $table->string('fungsi_ht');
        });

        Schema::create('merk_ht', function (Blueprint $table) {
            $table->id();
            $table->string('merk_ht');
            $table->foreignId('id_jenis_ht')->constrained('jenis_ht')->onUpdate('cascade');
        });

        Schema::create('info_ht', function (Blueprint $table) {
            $table->id();
            $table->string('sn_ht')->unique();
            $table->string('sn_baterai')->unique();
            $table->foreignId('id_merk_ht')->constrained('merk_ht')->onUpdate('cascade');
            $table->tinyInteger('assigned');
        });

        //Pengguna Handler
        Schema::create('pengguna_ht', function (Blueprint $table) {
            $table->id();
            $table->string('no_pegawai');
            $table->string('nama');
            $table->string('status_pekerja');
            $table->foreignId('id_alamat_kerja')->constrained('alamat')->onUpdate('cascade');
        });

        //Status Handler
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_alokasi');
            $table->date('tanggal_cek');
            $table->date('tanggal_penarikan');
            $table->string('foto_alat');
            $table->string('sn_ht');
            $table->foreign('sn_ht')->references('sn_ht')->on('info_ht')->onUpdate('cascade');
            $table->string('surat_terima');
            $table->foreignId('id_pengguna_ht')->unique()->constrained('pengguna_ht')->onUpdate('cascade');
            $table->tinyInteger('status');
            $table->string('kondisi');
            $table->foreignId('id_alamat')->constrained('alamat')->onUpdate('cascade');
            $table->tinyInteger('redacted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lokasi');
        Schema::dropIfExists('alamat');

        Schema::dropIfExists('jenis_ht');
        Schema::dropIfExists('merk_ht');
        Schema::dropIfExists('info_ht');

        Schema::dropIfExists('pengguna_ht');

        Schema::dropIfExists('status');
    }
}
