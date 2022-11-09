<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contact;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create();
        Contact::factory()->count(50)->create();
        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            AttributeValueSeeder::class,
        ]);
//        Product::factory()->count(1000)->create();
    }
}
