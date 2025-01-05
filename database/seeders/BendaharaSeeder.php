<?php

namespace Database\Seeders;

use App\Models\Bendahara\JenisPembayaran;
use App\Models\Zis\JenisZis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BendaharaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisPembayaran::create(['nama' => 'CASH', 'short_name' => 'cash', 'is_active' => true]);
        JenisPembayaran::create(['nama' => 'QRIS', 'short_name' => 'qris', 'is_active' => true]);
        JenisPembayaran::create(['nama' => 'TRANSFER', 'short_name' => 'transfer', 'is_active' => true]);
        JenisPembayaran::create(['nama' => 'BERAS', 'short_name' => 'beras', 'is_active' => true]);
        JenisPembayaran::create(['nama' => 'LAINNYA', 'short_name' => 'lainnya', 'is_active' => true]);

        JenisZis::create(['nama' => 'Zakat Fitrah', 'short_name' => 'fitrah']);
        JenisZis::create(['nama' => 'Fidyah', 'short_name' => 'fidyah']);
        JenisZis::create(['nama' => 'Mall', 'short_name' => 'mall']);
    }
}
