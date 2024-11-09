<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'MP QUIC Admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
            'address' => 'Jl. Mastrip No. 164 Jember',
        ]);

        $this->call([
            AlatTableSeeder::class,
            DataTableSeeder::class,
        ]);
    }
}
