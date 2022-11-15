<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objs = [
            ['Monitorlar', 'Monitors', 'Monitor', 'Monitor'],
            ['Klawiaturalar', 'Keyboards', 'Klawiatura', 'Keyboard'],
            ['Mobil Telefonlar', 'Mobiles', 'Mobil telefon', 'Mobile'],
            ['Syçanjyklar', 'Mouses', 'Syçanjyk', 'Mouse'],
            ['Printerler', 'Printers', 'Printer', 'Printer'],
            ['Skanerlar', 'Scaners', 'Skaner', 'Scaner'],
            ['Oyun Noutbuklar', 'Gaming Notebooks', 'Oyun noutbuk', 'Gaming notebook'],
            ['Noutbuklar', 'Notebooks', 'Noutbuk', 'Notebook'],
        ];
        foreach ($objs as $obj) {
            Category::create([
                'name_tm' => $obj[0],
                'name_en' => $obj[1],
                'product_tm' => $obj[2],
                'product_en' => $obj[3],
                'slug' => str($obj[0])->slug(),
            ]);
        }
    }
}
