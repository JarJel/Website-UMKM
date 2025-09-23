<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id('id_keranjang');
            $table->unsignedBigInteger('id_pengguna');
            $table->unsignedBigInteger('id_produk');
            $table->integer('jumlah')->default(1);
            $table->timestamps();

            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
