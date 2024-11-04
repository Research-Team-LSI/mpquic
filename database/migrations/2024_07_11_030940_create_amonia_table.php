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
        Schema::create('amonia', function (Blueprint $table) {
            $table->id('id_amonia');
            $table->unsignedInteger('id_alat')->length(3);
            $table->float('nilai_amonia', 8, 3);
            $table->timestamps();
            $table->foreign('id_alat')->references('id_alat')->on('alat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amonia');
    }
};
