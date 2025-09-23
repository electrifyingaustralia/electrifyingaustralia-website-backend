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
            $table->string('name');
            $table->string('model_number');
            $table->text('short_description')->nullable();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->string('warranty')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('product_link')->nullable();
            $table->foreignId('media_id')->nullable()->constrained('media_libraries')->nullOnDelete();
            $table->enum('product_type', ['solar_panel', 'battery', 'ev_charger', 'inverter']);
            // $table->string('weight')->nullable();
            // $table->longText('description')->nullable();

            // // Solar Panel Specific
            // $table->string('solar_panel_efficiency')->nullable();
            // $table->string('solar_cell_type')->nullable();
            // $table->string('solar_cell_max_power_output')->nullable();
            // $table->string('solar_panel_technology')->nullable();
            // $table->string('solar_cell_temp_coefficient')->nullable();
            // $table->string('solar_cell_performance_warranty')->nullable();

            // // Battery Specific
            // $table->string('battery_capacity')->nullable();
            // $table->string('battery_type')->nullable();
            // $table->string('battery_phase')->nullable();
            // $table->string('battery_charging_time')->nullable();
            // $table->string('battery_weather_rating')->nullable();

            // // EV Charger Specific
            // $table->string('ev_charger_type')->nullable(); // Level 1, Level 2, DC Fast Charger
            // $table->string('ev_charging_speed')->nullable();
            // $table->string('ev_connector_type')->nullable(); // Type 1, Type 2, CCS, CHAdeMO
            // $table->string('ev_output_power')->nullable();
            // $table->string('ev_cable_length')->nullable();
            // $table->boolean('ev_portable')->default(false);

            // // Inverter Specific
            // $table->string('inverter_type')->nullable(); // String, Micro, Hybrid, Off-grid
            // $table->string('inverter_input_voltage')->nullable();
            // $table->string('inverter_output_voltage')->nullable();
            // $table->string('inverter_frequency')->nullable(); // 50Hz or 60Hz
            // $table->string('inverter_phase_type')->nullable(); // Single-phase, Three-phase
            // $table->string('max_input_power')->nullable();
            // $table->integer('inverter_number_of_mppts')->nullable(); // Maximum Power Point Trackers
            // $table->boolean('inverter_grid_tie')->default(false);
            // $table->boolean('inverter_battery_backup')->default(false);

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
