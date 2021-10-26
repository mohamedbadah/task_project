<?php

namespace Database\Seeders;

use App\Models\OrederProduct;
use Illuminate\Database\Seeder;

class OrederProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrederProduct::factory(10)->create();
    }
}
