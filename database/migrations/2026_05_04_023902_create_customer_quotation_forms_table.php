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
        Schema::create('customer_quotation_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();

            $table->json('interests')->nullable(); // ! ["Solar System", "Battery Storage"]
            $table->string('proposal_type')->nullable();

            $table->string('solar_existing_system')->nullable();
            $table->string('solar_existing_age')->nullable();
            $table->string('solar_system_size')->nullable();
            $table->string('solar_roof_type')->nullable();
            $table->string('solar_existing_size')->nullable();

            $table->string('battery_capacity')->nullable();
            $table->string('battery_upgrade_type')->nullable();
            $table->string('battery_existing')->nullable();
            $table->string('battery_existing_age')->nullable();

            $table->string('ev_charger_existing')->nullable();
            $table->string('ev_charger_type')->nullable();
            $table->string('ev_charger_install_location')->nullable();
            $table->string('ev_charger_upgrade_type')->nullable();

            // ! Common fields
            $table->string('phase_type')->nullable();
            $table->string('switchboard_distance')->nullable();
            $table->string('bill_amount')->nullable();
            $table->string('bill_period')->nullable();
            $table->string('property_type')->nullable();
            $table->string('installation_timeframe')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_quotation_forms');
    }
};
