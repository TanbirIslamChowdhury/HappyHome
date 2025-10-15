<?php
<?php
<?php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        /*

        ,"":null,"":"3","":"4","":"6","":null,"":null,"distance":"7.00","base_price":"500.00","unit_price":"15.00","service_price":"605","booking_date":"2025-10-15"}
        */
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->bigInteger('service_id');
            $table->bigInteger('area_from')->nullable();
            $table->bigInteger('area_to')->nullable();
            $table->bigInteger('area_sqft')->nullable();
            $table->bigInteger('hours')->nullable();
            $table->foreignId('service_package_id')->constrained('service_packages')->onDelete('cascade');
            $table->foreignId('provider_id')->nullable()->constrained('service_providers')->onDelete('set null');
            $table->enum('status', ['pending', 'accepted', 'in-progress', 'completed', 'cancelled'])->default('pending');
            $table->dateTime('booking_date');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('bookings');
    }
};
