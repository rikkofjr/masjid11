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
        Schema::create('tb_jenis_zis', function (Blueprint $table){
            $table->uuid('id')->primary()->unique();
            $table->string('nama');
            $table->string('short_name')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tb_standarisasi_zakat_fitrah', function (Blueprint $table){
            $table->uuid('id')->primary()->unique();
            $table->string('nama');
            $table->string('gambar');
            $table->integer('nominal');
            $table->string('short_name')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tb_zis_penerimaan', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('amil');
            $table->string('amil_editor')->nullable();
            $table->foreignUuid('id_jenis_zis')->references('id')->on('tb_jenis_zis');
            $table->text('atas_nama');
            $table->text('nama_lain')->nullable();
            $table->integer('jumlah_jiwa');
            $table->integer('uang')->nullable();
            $table->integer('uang_infaq')->nullable();
            $table->integer('total_tagihan')->nullable();
            $table->double('beras', 8,2)->nullable();
            $table->double('beras_infaq', 8,2)->nullable();
            $table->string('snap_token')->nullable();
            $table->foreignUuid('id_jenis_pembayaran')->references('id')->on('tb_jenis_pembayaran')->nullable();
            $table->date('hijri');
            $table->string('status_pembayaran');
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
