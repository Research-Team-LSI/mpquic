<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('data')->insert([
            [
                'id_alat' => 1,
                'throughput' => 50.123,
                'latency' => 10.456,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_alat' => 2,
                'throughput' => 75.567,
                'latency' => 20.789,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_alat' => 3,
                'throughput' => 40.123,
                'latency' => 11.456,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_alat' => 4,
                'throughput' => 33.123,
                'latency' => 10.456,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_alat' => 5,
                'throughput' => 28.123,
                'latency' => 10.456,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_alat' => 6,
                'throughput' => 18.123,
                'latency' => 10.456,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
