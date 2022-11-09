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
            ['Monitorlar', 'Monitors'],
            ['Klawituralar', 'Keyboards'],
            ['Mobil telefonlar', 'Mobiles'],
            ['Syçanjyklar', 'Mouses'],
            ['Printerler', 'Printers'],
            ['Skanerlar', 'Scaners'],
            ['Oyun laptoplar', 'Gaming Laptop'],
            ['Notbuklar', 'Notebook'],
        ];
        foreach ($objs as $obj) {
            Category::create([
                'name_tm' => $obj[0],
                'name_en' => $obj[1],
                'slug' => str($obj[0])->slug(),
            ]);
        }
    }
}
