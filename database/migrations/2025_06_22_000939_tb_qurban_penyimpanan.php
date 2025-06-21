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
        Schema::create('tb_qurban_penyimpanan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_gudang_penyimpanan')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('tb_qurban_stock', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('kuantitas');
            $table->string('status');
            $table->foreignUuid('id_qurban_penyimpanan')->references('id')->on('tb_qurban_penyimpanan')->nullable();
            $table->foreignUuid('id_user')->references('id')->on('users')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_qurban_stock');
        Schema::dropIfExists('tb_qurban_penyimpanan');
    }
};
