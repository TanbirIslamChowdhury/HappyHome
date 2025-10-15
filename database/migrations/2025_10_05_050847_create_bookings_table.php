<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->bigInteger('service_id');
            $table->bigInteger('area_from')->nullable();
            $table->bigInteger('area_to')->nullable();
            $table->bigInteger('area_sqft')->nullable();
            $table->bigInteger('hours')->nullable();
            $table->bigInteger('distance')->nullable();
            $table->decimal('base_price',10,2)->nullable();
            $table->decimal('unit_price',10,2)->nullable();
            $table->decimal('service_price',10,2)->nullable();
            $table->bigInteger('provider_id')->nullable();
            $table->enum('status', ['pending', 'accepted', 'in-progress', 'completed', 'cancelled'])->default('pending');
            $table->dateTime('booking_date');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('bookings');
    }
};
