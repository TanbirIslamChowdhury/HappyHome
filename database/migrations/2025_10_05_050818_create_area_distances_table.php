<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('area_distances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_area_id')->constrained('areas')->onDelete('cascade');
            $table->foreignId('to_area_id')->constrained('areas')->onDelete('cascade');
            $table->decimal('distance_km', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('area_distances');
    }
};
