<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Nike',
                'link' => 'https://www.nike.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Adidas',
                'link' => 'https://www.adidas.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Apple',
                'link' => 'https://www.apple.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung',
                'link' => 'https://www.samsung.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sony',
                'link' => 'https://www.sony.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Microsoft',
                'link' => 'https://www.microsoft.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Google',
                'link' => 'https://www.google.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Amazon',
                'link' => 'https://www.amazon.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tesla',
                'link' => 'https://www.tesla.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coca-Cola',
                'link' => 'https://www.coca-cola.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pepsi',
                'link' => 'https://www.pepsi.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'McDonald\'s',
                'link' => 'https://www.mcdonalds.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Starbucks',
                'link' => 'https://www.starbucks.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Toyota',
                'link' => 'https://www.toyota.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Honda',
                'link' => 'https://www.honda.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ford',
                'link' => 'https://www.ford.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'BMW',
                'link' => 'https://www.bmw.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mercedes-Benz',
                'link' => 'https://www.mercedes-benz.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Audi',
                'link' => 'https://www.audi.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Volkswagen',
                'link' => 'https://www.vw.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Intel',
                'link' => 'https://www.intel.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dell',
                'link' => 'https://www.dell.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HP',
                'link' => 'https://www.hp.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lenovo',
                'link' => 'https://www.lenovo.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Canon',
                'link' => 'https://www.canon.com',
                'logo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('brands')->insert($brands);
    }
}
