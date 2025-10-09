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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();

            $table->string('slug');

            $table->string('designation');

            $table->string('email')->nullable();

            $table->string('phone')->nullable();

            $table->foreignId('media_id')->nullable()->constrained('media_libraries')->nullOnDelete();

            $table->longText('description')->nullable();

            $table->boolean('status')->default(true);

            $table->integer('order')->default(0);

            $table->string('twitter_link')->nullable();

            $table->string('instagram_link')->nullable();

            $table->string('facebook_link')->nullable();

            $table->string('pinterest_link')->nullable();

            $table->string('linkedin_link')->nullable();

            $table->string('youtube_link')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
