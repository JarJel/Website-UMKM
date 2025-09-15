<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('bumdes', function (Blueprint $table) {
            $table->id('id_bumdes'); 
            $table->unsignedBigInteger('id_desa')->nullable();
            $table->unsignedBigInteger('id_pengguna')->nullable();
            $table->string('nama_bumdes');
            $table->string('kata_sandi'); // kolom baru yang kamu minta
            $table->text('deskripsi')->nullable();
            $table->string('alamat_bumdes')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->decimal('rating_bumdes', 3, 2)->default(0);
            $table->integer('jumlah_rating_bumdes')->default(0);
            $table->timestamp('tanggal_dibuat')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Rollback migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('bumdes');
    }
};
