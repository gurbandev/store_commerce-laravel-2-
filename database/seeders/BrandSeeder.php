<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objs = [
            'ACER',
            'APPLE',
            'ASUS',
            'DELL',
            'FUJITSU',
            'HP',
            'LENOVO',
            'MSI',
            'SAMSUNG',
            'SONY',
            'TOSHIBA',
            'XIAOMI',
        ];
        foreach ($objs as $obj) {
            Brand::create([
                'name' => $obj,
                'slug' => str($obj)->slug(),
            ]);
        }
    }
}
