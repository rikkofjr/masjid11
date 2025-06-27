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
         Schema::create('tb_qurban_tracking', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_qurban_penerimaan');
            $table->string('status');
            $table->string('keterangan')->nullable();
            $table->uuid('petugas')->nullable();
            $table->timestamps();

            $table->foreign('id_qurban_penerimaan')->references('id')->on('tb_qurban_penerimaan')->onDelete('cascade');
            $table->foreign('petugas')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('tb_qurban_tracking');
    }
};
