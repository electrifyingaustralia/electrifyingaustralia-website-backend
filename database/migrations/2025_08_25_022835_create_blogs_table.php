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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->string('slug');

            $table->string('subtitle')->nullable();

            $table->longText('short_description')->nullable();

            $table->longText('description')->nullable();

            $table->foreignId('media_id')->nullable()->constrained('media_libraries')->nullOnDelete();

            $table->foreignId('blog_category_id')->constrained('blog_categories')->cascadeOnDelete();

            $table->string('facebook_link')->nullable();

            $table->string('twitter_link')->nullable();

            $table->string('linkedin_link')->nullable();

            $table->string('youtube_link')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
