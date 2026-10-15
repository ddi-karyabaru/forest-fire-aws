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
        Schema::create('sensor_logs', function (Blueprint $table) {
    $table->id();
    $table->float('temperature');
    $table->float('humidity');
    $table->integer('soil_moisture');
    $table->integer('mq2_value');
    $table->string('flame_status');
    $table->string('status_warning'); // Potensi, Hati-hati, Darurat, Aman
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_logs');
    }
};
