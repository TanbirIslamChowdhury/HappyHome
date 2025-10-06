<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('provider_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained('service_providers')->onDelete('cascade');
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('provider_ratings');
    }
};
