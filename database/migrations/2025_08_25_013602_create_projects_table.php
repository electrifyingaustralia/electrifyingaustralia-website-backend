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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('title')->unique();

            $table->string('slug');

            $table->string('subtitle');

            $table->longText('description')->nullable();

            $table->foreignId('project_category_id')->constrained('project_categories')->cascadeOnDelete();

            $table->foreignId('project_type_id')->constrained('project_types')->cascadeOnDelete();

            $table->string('location', 255)->nullable();

            $table->string('extra_info_1', 255)->nullable();

            $table->string('extra_info_2', 255)->nullable();

            $table->string('extra_info_3', 255)->nullable();

            $table->string('extra_info_4', 255)->nullable();

            $table->string('extra_info_5', 255)->nullable();

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
