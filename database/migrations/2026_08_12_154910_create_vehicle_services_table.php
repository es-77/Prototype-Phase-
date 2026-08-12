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
        // create vehicle service table in DB for the CRUD tasks
        Schema::create('vehicle_services', function (Blueprint $table) {
            $table->id('ServiceId');
            $table->string('ServiceName');
            $table->string('VehicleModel');
            $table->string('ServiceType');
            $table->decimal('ServiceAmount', 10, 2);
            $table->string('Picture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_services');
    }
};
