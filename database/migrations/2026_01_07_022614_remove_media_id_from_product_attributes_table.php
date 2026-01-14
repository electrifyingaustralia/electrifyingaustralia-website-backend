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
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->dropForeign(['media_id']);
        });

        Schema::table('product_attributes', function (Blueprint $table) {
            $table->dropColumn('media_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->foreignId('media_id')
                ->after('attrs_value')
                ->nullable()
                ->constrained('media_libraries')
                ->nullOnDelete();
        });
    }
};
