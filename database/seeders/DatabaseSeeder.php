<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\BarangSeeder;
use Database\Seeders\AlternatifSeeder;
use Database\Seeders\KriteriaSeeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            BarangSeeder::class,
            AlternatifSeeder::class,
            KriteriaSeeder::class,
            // Tambahkan seeder lain jika ada
        ]);
    }
}