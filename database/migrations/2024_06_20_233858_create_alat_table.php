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
        Schema::create('alat', function (Blueprint $table) {
            $table->integer('id_alat')->unsigned()->length(3)->primary();
            $table->enum('protocol', ['http', 'mpquic']);
            $table->enum('microcontroller', ['esp32', 'esp8266', 'raspberrypi']);
            $table->string('mac_address', 20);
            $table->string('ip_address', 16);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat');
    }
};
