<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('id_pengguna');
            $table->string('email')->unique();
            $table->string('nama_pengguna')->unique();
            $table->string('kata_sandi');
            $table->string('nama_lengkap');
            $table->string('nomor_telepon')->nullable();
            $table->tinyInteger('id_role')->default(2); // 1=admin, 2=seller, dst
            $table->string('sku')->nullable();
            $table->string('ktp')->nullable();
            $table->string('no_rekening')->nullable();
            $table->unsignedBigInteger('id_desa')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
