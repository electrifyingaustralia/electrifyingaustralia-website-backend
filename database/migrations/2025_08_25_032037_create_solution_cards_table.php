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
        Schema::create('solution_cards', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->text('description');

            $table->text('bold_info');

            $table->text('extra_info');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solution_cards');
    }
};
