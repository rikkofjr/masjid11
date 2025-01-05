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
        Schema::create('tb_kelompok_transaksi', function (Blueprint $table){
            $table->uuid('id')->primary()->unique();
            $table->string('nomor_kelompok_kas')->unique();
            $table->string('nama');
            $table->foreignUuid('id_penanggung_jawab')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('tb_transaksi_kas', function (Blueprint $table){
            $table->uuid('id')->primary()->unique();
            $table->foreignUuid('id_kelompok_transaksi')->references('id')->on('tb_kelompok_transaksi')->cascadeOnDelete();
            $table->string('keterangan');
            $table->text('keterangan_tambahan')->nullable();
            $table->integer('penerimaan')->nullable();
            $table->integer('pengeluaran')->nullable();
            $table->enum('tipe', ['penerimaan', 'pengeluaran'])->default('penerimaan');
            $table->foreignUuid('id_jenis_pembayaran')->references('id')->on('tb_jenis_pembayaran')->cascadeOnDelete();
            $table->foreignUuid('id_penanggung_jawab')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
