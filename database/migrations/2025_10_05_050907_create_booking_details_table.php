<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->integer('area_sqft')->nullable();   // cleaning, painting
            $table->integer('hours')->nullable();       // plumber, electrician, carpenter
            $table->integer('distance_km')->nullable(); // shifting
            $table->foreignId('pickup_area_id')->nullable()->constrained('areas')->onDelete('set null');
            $table->foreignId('delivery_area_id')->nullable()->constrained('areas')->onDelete('set null');
            $table->integer('pickup_floor')->nullable();
            $table->integer('delivery_floor')->nullable();
            $table->text('notes')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('booking_details');
    }
};
