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
            ['Oyun Monitorlar', 'Gaming Monitors', 'Oyun monitor', 'Gaming monitor', 1],
            ['Oyun Klawiaturalar', 'Gaming Keyboards', 'Oyun klawiatura', 'Gaming keyboard', 1],
            ['Oyun Syçanjyklar', 'Gaming Mouses', 'Oyun syçanjyk', 'Gaming mouse', 1],
            ['Oyun Noutbuklar', 'Gaming Notebooks', 'Oyun noutbuk', 'Gaming notebook', 1],
            ['Kompýuter Kreslolary', 'Computer Chairs', 'Kompýuter kreslo', 'Computer chair', 1],
            ['Monitorlar', 'Monitors', 'Monitor', 'Monitor', 0],
            ['Klawiaturalar', 'Keyboards', 'Klawiatura', 'Keyboard', 0],
            ['Syçanjyklar', 'Mouses', 'Syçanjyk', 'Mouse', 0],
            ['Noutbuklar', 'Notebooks', 'Noutbuk', 'Notebook', 0],
            ['Printerler', 'Printers', 'Printer', 'Printer', 0],
        ];
        for ($i = 0; $i < count($objs); $i++) {
            Category::create([
                'name_tm' => $objs[$i][0],
                'name_en' => $objs[$i][1],
                'product_tm' => $objs[$i][2],
                'product_en' => $objs[$i][3],
                'home' => $objs[$i][4],
                'sort_order' => $i + 1,
            ]);
        }
    }
}
