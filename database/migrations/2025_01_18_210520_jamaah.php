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
        Schema::create('tb_jamaah_keluarga', function (Blueprint $table){
            $table->uuid('id')->primary()->unique();
            $table->string('tipe');
            $table->string('status');
            $table->string('nama_keluarga');
            $table->text('alamat');
            $table->foreignUuid('id_penanggung_jawab')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('tb_jamaah_nama', function (Blueprint $table){
            $table->uuid('id')->primary()->unique();
            $table->foreignUuid('id_jamaah_keluarga')->references('id')->on('tb_jamaah_keluarga')->cascadeOnDelete();
            $table->string('nama_jamaah');
            $table->date('tanggal_lahir');
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
