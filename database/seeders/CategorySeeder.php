<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::create(2025, 10, 8, 16, 43, 30);

        $categories = [
            ['category_name' => 'CPU', 'slug' => 'cpu'],
            ['category_name' => 'RAM', 'slug' => 'ram'],
            ['category_name' => 'Mainboard', 'slug' => 'motherboard'],
            ['category_name' => 'VGA', 'slug' => 'gpu'],
            ['category_name' => 'Ổ cứng SSD', 'slug' => 'ssd'],
            ['category_name' => 'Nguồn', 'slug' => 'PSU'],
            ['category_name' => 'Case', 'slug' => 'case'],
            ['category_name' => 'Tản nhiệt', 'slug' => 'cooler'],
            ['category_name' => 'Phụ kiện', 'slug' => 'peripherals'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'category_name' => $category['category_name'],
                'slug' => $category['slug'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
