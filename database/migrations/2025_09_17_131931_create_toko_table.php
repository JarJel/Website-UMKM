<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('toko', function (Blueprint $table) {
            $table->id('id_toko');
            $table->unsignedBigInteger('id_pengguna');
            $table->unsignedBigInteger('id_bumdes')->nullable();
            $table->unsignedBigInteger('id_desa')->nullable();
            $table->string('nama_toko');
            $table->string('slug_toko');
            $table->enum('status_verifikasi', ['pending','verified','rejected'])->default('pending');
            $table->dateTime('tanggal_daftar')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->timestamps();

            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna')->onDelete('cascade');
            $table->foreign('id_bumdes')->references('id_bumdes')->on('bumdes')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('toko');
    }
};
