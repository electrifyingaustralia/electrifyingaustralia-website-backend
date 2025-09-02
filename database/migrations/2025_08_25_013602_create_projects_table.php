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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->string('subtitle');

            $table->longText('description')->nullable();

            $table->string('solar_panel')->nullable();

            $table->string('inverter')->nullable();

            $table->string('type', 50)->default('commercial');

            $table->string('location', 255)->nullable();

            $table->foreignId('media_id')->nullable()->constrained('media_libraries')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
