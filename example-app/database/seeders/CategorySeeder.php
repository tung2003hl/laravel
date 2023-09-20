<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['category_name' =>  'Food','description' => 'Category for food items'],
            ['category_name' => 'Drink','description' => 'Category for beverages'],
            ['category_name' => 'Market','description' => 'Category for market items'],
            ['category_name' => 'Flower','description' => 'Category for flowers'],
        ];

        DB::table('categories')->insert($categories);
    }
}
