<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warehouse;
use Faker\Factory as Faker;

class WarehouseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            Warehouse::create([
                'name' => $faker->word,
                'location' => $faker->address,
            ]);
        }
    }
}
