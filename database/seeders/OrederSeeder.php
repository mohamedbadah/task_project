<?php

namespace Database\Seeders;

use App\Models\Oreder;
use Illuminate\Database\Seeder;

class OrederSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Oreder::factory(30)->create();
    }
}
