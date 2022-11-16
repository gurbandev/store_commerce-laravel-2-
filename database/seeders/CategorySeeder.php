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
            ['Oyun Monitorlar', 'Gaming Monitors', 'Oyun monitor', 'Gaming monitor'],
            ['Klawiaturalar', 'Keyboards', 'Klawiatura', 'Keyboard'],
            ['Oyun Klawiaturalar', 'Gaming Keyboards', 'Oyun klawiatura', 'Gaming keyboard'],
            ['Syçanjyklar', 'Mouses', 'Syçanjyk', 'Mouse'],
            ['Oyun Syçanjyklar', 'Gaming Mouses', 'Oyun syçanjyk', 'Gaming mouse'],
            ['Noutbuklar', 'Notebooks', 'Noutbuk', 'Notebook'],
            ['Oyun Noutbuklar', 'Gaming Notebooks', 'Oyun noutbuk', 'Gaming notebook'],
            ['Kompýuter Kreslolary', 'Computer Chairs', 'Kompýuter kreslo', 'Computer chair'],
            ['Printerler', 'Printers', 'Printer', 'Printer'],
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
