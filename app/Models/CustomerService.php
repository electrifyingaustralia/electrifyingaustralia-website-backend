<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerService extends Model
{
    protected $guarded = [];

    const PRODUCT_TYPES = [
        'solar_panel'       => 'Solar Panel',
        'battery_storage'   => 'Battery Storage',
        'ev_charger'        => 'EV Charger',
        'inverter'          => 'Inverter',
        'solar_accessories' => 'Solar Accessories',
        'energy_monitoring' => 'Energy Monitoring System',
    ];

    const ISSUE_TYPES = [
        'no_power'            => 'Not Working / No Power',
        'performance_drop'    => 'Performance Drop',
        'physical_damage'     => 'Physical Damage',
        'charging_connection' => 'Charging/Connection Issue',
        'app_monitoring'      => 'App/Monitoring Issue',
        'installation'        => 'Installation Issue',
        'warranty_claim'      => 'Warranty Claim',
        'other'               => 'Other',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getProductTypeOptions(): array
    {
        return self::PRODUCT_TYPES;
    }

    public function getIssueTypeOptions(): array
    {
        return self::ISSUE_TYPES;
    }
}
