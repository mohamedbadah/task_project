<?php

namespace Database\Seeders;

use App\Models\sub_categories;
use Illuminate\Database\Seeder;

class SubCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        sub_categories::factory(30)->create();
    }
}
