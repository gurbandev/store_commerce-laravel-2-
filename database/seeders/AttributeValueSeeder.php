<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objs = [
            ['name_tm' => 'Reňk', 'name_en' => 'Color', 'values' => [
                ['name_tm' => 'Ak', 'name_en' => 'White'],
                ['name_tm' => 'Gara', 'name_en' => 'Black'],
                ['name_tm' => 'Çal', 'name_en' => 'Gray'],
                ['name_tm' => 'Gyzyl', 'name_en' => 'Red'],
                ['name_tm' => 'Ýaşyl', 'name_en' => 'Green'],
                ['name_tm' => 'Gök', 'name_en' => 'Blue'],
            ]],
            ['name_tm' => 'RAM', 'name_en' => null, 'values' => [
                ['name_tm' => '2 GB', 'name_en' => null],
                ['name_tm' => '4 GB', 'name_en' => null],
                ['name_tm' => '6 GB', 'name_en' => null],
                ['name_tm' => '8 GB', 'name_en' => null],
                ['name_tm' => '12 GB', 'name_en' => null],
                ['name_tm' => '16 GB', 'name_en' => null],
            ]],
            ['name_tm' => 'SSD', 'name_en' => null, 'values' => [
                ['name_tm' => '128 GB', 'name_en' => null],
                ['name_tm' => '256 GB', 'name_en' => null],
                ['name_tm' => '512 GB', 'name_en' => null],
                ['name_tm' => '1 TB', 'name_en' => null],
            ]],
            ['name_tm' => 'HDD', 'name_en' => null, 'values' => [
                ['name_tm' => '128 GB', 'name_en' => null],
                ['name_tm' => '256 GB', 'name_en' => null],
                ['name_tm' => '512 GB', 'name_en' => null],
                ['name_tm' => '1 TB', 'name_en' => null],
            ]],
            ['name_tm' => 'Diagonal', 'name_en' => 'Diagonal', 'values' => [
                ['name_tm' => '13.3"', 'name_en' => null],
                ['name_tm' => '14"', 'name_en' => null],
                ['name_tm' => '15.6"', 'name_en' => null],
                ['name_tm' => '17.3"', 'name_en' => null],
                ['name_tm' => '19"', 'name_en' => null],
                ['name_tm' => '20"', 'name_en' => null],
            ]],
        ];
        for ($i = 0; $i < count($objs); $i++) {
            $attribute = Attribute::create([
                'name_tm' => $objs[$i]['name_tm'],
                'name_en' => $objs[$i]['name_en'],
                'sort_order' => $i + 1,
            ]);
            for ($j = 0; $j < count($objs[$i]['values']); $j++) {
                AttributeValue::create([
                    'attribute_id' => $attribute->id,
                    'name_tm' => $objs[$i]['values'][$j]['name_tm'],
                    'name_en' => $objs[$i]['values'][$j]['name_en'],
                    'sort_order' => $j + 1,
                ]);
            }
        }
    }
}
