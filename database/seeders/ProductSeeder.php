<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample product data with realistic names for each product type
        $products = [
            // Solar Panels
            [
                'name' => 'SunPower Maxeon 3',
                'model_number' => 'SP-MAX3-400',
                'short_description' => 'High-efficiency solar panel with 22.8% efficiency rating',
                'product_type' => 'solar_panel'
            ],
            [
                'name' => 'LG NeON R',
                'model_number' => 'LG-NEONR-380',
                'short_description' => 'Premium solar panel with enhanced durability and performance',
                'product_type' => 'solar_panel'
            ],
            [
                'name' => 'Canadian Solar HiKu',
                'model_number' => 'CS-HIKU-450',
                'short_description' => 'High-power monocrystalline solar panel for residential use',
                'product_type' => 'solar_panel'
            ],
            [
                'name' => 'Jinko Solar Tiger Pro',
                'model_number' => 'JK-TPRO-480',
                'short_description' => 'Advanced n-type solar panel with excellent low-light performance',
                'product_type' => 'solar_panel'
            ],
            [
                'name' => 'Trina Solar Vertex',
                'model_number' => 'TS-VERTEX-500',
                'short_description' => 'Ultra-high power solar panel with multi-busbar technology',
                'product_type' => 'solar_panel'
            ],

            // Batteries
            [
                'name' => 'Tesla Powerwall 2',
                'model_number' => 'T-PW2-13.5',
                'short_description' => 'Home battery storage system with 13.5 kWh capacity',
                'product_type' => 'battery'
            ],
            [
                'name' => 'LG Chem RESU',
                'model_number' => 'LG-RESU-10',
                'short_description' => 'Compact lithium-ion battery for residential energy storage',
                'product_type' => 'battery'
            ],
            [
                'name' => 'Enphase Encharge',
                'model_number' => 'EN-ENC-3T',
                'short_description' => 'Modular battery system with built-in inverter technology',
                'product_type' => 'battery'
            ],
            [
                'name' => 'Sonnen Eco',
                'model_number' => 'SON-ECO-10',
                'short_description' => 'German-engineered battery system with smart energy management',
                'product_type' => 'battery'
            ],
            [
                'name' => 'BYD B-Box',
                'model_number' => 'BYD-BBOX-12',
                'short_description' => 'High-capacity lithium iron phosphate battery for home use',
                'product_type' => 'battery'
            ],

            // EV Chargers
            [
                'name' => 'ChargePoint Home Flex',
                'model_number' => 'CP-HF-50',
                'short_description' => 'Smart EV charger with up to 50 amp charging capability',
                'product_type' => 'ev_charger'
            ],
            [
                'name' => 'Tesla Wall Connector',
                'model_number' => 'T-WC-G3',
                'short_description' => 'Dedicated Tesla charger with Wi-Fi connectivity',
                'product_type' => 'ev_charger'
            ],
            [
                'name' => 'JuiceBox 40',
                'model_number' => 'JB-40-EN',
                'short_description' => 'Smart charging station with energy monitoring features',
                'product_type' => 'ev_charger'
            ],
            [
                'name' => 'ClipperCreek HCS-40',
                'model_number' => 'CC-HCS-40',
                'short_description' => 'Durable Level 2 EV charger with NEMA 14-50 plug',
                'product_type' => 'ev_charger'
            ],
            [
                'name' => 'Grizzl-E Classic',
                'model_number' => 'GRZ-CL-40',
                'short_description' => 'Heavy-duty EV charger designed for all weather conditions',
                'product_type' => 'ev_charger'
            ],

            // Inverters
            [
                'name' => 'SolarEdge HD-Wave',
                'model_number' => 'SE-HDW-7.6',
                'short_description' => 'Advanced string inverter with power optimizer technology',
                'product_type' => 'inverter'
            ],
            [
                'name' => 'Enphase IQ8+',
                'model_number' => 'EN-IQ8P-300',
                'short_description' => 'Microinverter system with sunlight backup capability',
                'product_type' => 'inverter'
            ],
            [
                'name' => 'Fronius Primo',
                'model_number' => 'FR-PRI-8.2',
                'short_description' => 'Reliable string inverter with high efficiency rating',
                'product_type' => 'inverter'
            ],
            [
                'name' => 'Huawei SUN2000',
                'model_number' => 'HW-SUN2-5K',
                'short_description' => 'Smart string inverter with AI-powered optimization',
                'product_type' => 'inverter'
            ],
            [
                'name' => 'Generac PWRcell',
                'model_number' => 'GEN-PWR-7.6',
                'short_description' => 'Hybrid inverter with battery backup integration',
                'product_type' => 'inverter'
            ],

            // Additional products to reach 25
            [
                'name' => 'REC Alpha Pure',
                'model_number' => 'REC-AP-420',
                'short_description' => 'Eco-friendly solar panel with ultra-low carbon footprint',
                'product_type' => 'solar_panel'
            ],
            [
                'name' => 'Panasonic EverVolt',
                'model_number' => 'PAN-EV-2.0',
                'short_description' => 'Complete home energy storage and management system',
                'product_type' => 'battery'
            ],
            [
                'name' => 'Wallbox Pulsar Plus',
                'model_number' => 'WB-PP-48',
                'short_description' => 'Compact smart EV charger with power sharing feature',
                'product_type' => 'ev_charger'
            ],
            [
                'name' => 'SMA Sunny Boy',
                'model_number' => 'SMA-SB-7.7',
                'short_description' => 'Proven string inverter with robust design and reliability',
                'product_type' => 'inverter'
            ],
            [
                'name' => 'Qcells Q.PEAK DUO',
                'model_number' => 'QC-QPD-400',
                'short_description' => 'High-performance solar panel with half-cut cell technology',
                'product_type' => 'solar_panel'
            ]
        ];

        // Create products
        foreach ($products as $productData) {
            Product::factory()->create($productData);
        }
    }
}
