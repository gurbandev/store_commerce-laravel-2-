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
        Contact::factory()->count(10)->create();
        $this->call([
            UserSeeder::class,
            AttributeValueSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
        ]);
        Product::factory()->count(100)->create();
    }
}
