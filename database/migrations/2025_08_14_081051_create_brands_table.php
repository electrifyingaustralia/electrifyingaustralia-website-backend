<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();

            $table->string('slug');

            $table->string('link')->nullable();

            $table->unsignedBigInteger('logo_id')->nullable();

            $table->timestamps();

            $table->foreign('logo_id')->references('id')->on('media_libraries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
