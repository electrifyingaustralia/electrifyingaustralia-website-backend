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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();

            $table->string('slug');

            $table->string('model_number');

            $table->text('short_description')->nullable();

            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();

            $table->foreignId('product_type_id')->constrained('product_types')->cascadeOnDelete();

            $table->string('warranty')->nullable();

            $table->boolean('is_featured')->default(false);

            $table->boolean('is_active')->default(true);

            $table->string('product_link')->nullable();

            $table->foreignId('media_id')->nullable()->constrained('media_libraries')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
