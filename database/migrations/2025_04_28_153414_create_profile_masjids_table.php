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
        Schema::create('tb_profile_masjid', function (Blueprint $table) {
            $table->id();
            $table->mediumText('nama_masjid');
            $table->mediumText('alamat_masjid');
            $table->string('no_handphone');
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_profile_masjid');
    }
};
