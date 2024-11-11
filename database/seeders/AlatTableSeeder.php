<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlatTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('alat')->insert([
            [
                'protocol' => 'http',
                'microcontroller' => 'esp32',
                'mac_address' => 'AA:BB:CC:DD:EE:01',
                'ip_address' => '192.168.1.1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'protocol' => 'mpquic',
                'microcontroller' => 'raspberrypi',
                'mac_address' => 'AA:BB:CC:DD:EE:02',
                'ip_address' => '192.168.1.2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'protocol' => 'http',
                'microcontroller' => 'esp32',
                'mac_address' => 'AA:BB:CC:DD:EE:01',
                'ip_address' => '192.168.1.1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'protocol' => 'http',
                'microcontroller' => 'esp32',
                'mac_address' => 'AA:BB:CC:DD:EE:01',
                'ip_address' => '192.168.1.1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'protocol' => 'http',
                'microcontroller' => 'esp32',
                'mac_address' => 'AA:BB:CC:DD:EE:01',
                'ip_address' => '192.168.1.1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'protocol' => 'http',
                'microcontroller' => 'esp32',
                'mac_address' => 'AA:BB:CC:DD:EE:01',
                'ip_address' => '192.168.1.1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
