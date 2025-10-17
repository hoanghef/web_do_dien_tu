<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['category_name' => 'CPU']);
        Category::create(['category_name' => 'RAM']);
        Category::create(['category_name' => 'Mainboard']);
        Category::create(['category_name' => 'VGA']);
        Category::create(['category_name' => 'Ổ cứng SSD']);
        Category::create(['category_name' => 'Nguồn']);
        Category::create(['category_name' => 'Case']);
        Category::create(['category_name' => 'Tản nhiệt']);
        Category::create(['category_name' => 'Phụ kiện']);
    }
}
