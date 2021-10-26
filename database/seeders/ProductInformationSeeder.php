<?php

namespace Database\Seeders;

use App\Models\ProductInformation;
use Illuminate\Database\Seeder;

class ProductInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductInformation::factory(30)->create();
    }
}
