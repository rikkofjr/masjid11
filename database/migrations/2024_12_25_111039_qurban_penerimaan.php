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
        Schema::create('tb_qurban_penerimaan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('amil');
            $table->string('jenis_hewan');
            $table->text('atas_nama');
            $table->text('nama_lain')->nullable();
            $table->text('alamat');
            $table->text('permintaan');
            $table->string('nomor_handphone');
            $table->boolean('disaksikan')->default(true);
            $table->text('keterangan')->nullable();
            $table->string('status_terakhir')->nullable();
            $table->date('hijri');
            $table->string('nomor_hewan')->nullable();
            $table->string('photo_hewan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('amil')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_qurban_penerimaan');
    }
};
