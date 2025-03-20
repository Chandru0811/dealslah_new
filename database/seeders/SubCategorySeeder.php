<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_categories')->insert([
            [
                'category_id' => 2,
                'name' => 'Gaming Laptops',
                'slug' => 'gaming-laptops',
                'description' => 'High-performance laptops designed for gaming with powerful graphics and processors.',
                'path' => 'assets\images\deal_categories\Trending.svg',
                'active' => 1,
            ],
            [
                'category_id' => 2,
                'name' => 'Office Laptops',
                'slug' => 'office-laptops',
                'description' => 'Laptops optimized for productivity, business applications, and office work.',
                'path' => 'assets\images\deal_categories\Trending.svg',
                'active' => 1,
            ],
            [
                'category_id' => 2,
                'name' => 'Ultrabooks',
                'slug' => 'ultrabooks',
                'description' => 'Thin, lightweight laptops with high battery life and premium build quality.',
                'path' => 'assets\images\deal_categories\Trending.svg',
                'active' => 1,
            ],
            [
                'category_id' => 2,
                'name' => '2-in-1 Laptops',
                'slug' => '2-in-1-laptops',
                'description' => 'Convertible laptops that function as both a tablet and a traditional laptop.',
                'path' => 'assets\images\deal_categories\Trending.svg',
                'active' => 1,
            ],
            [
                'category_id' => 2,
                'name' => 'Student Laptops',
                'slug' => 'student-laptops',
                'description' => 'Affordable and reliable laptops designed for students and academic purposes.',
                'path' => 'assets\images\deal_categories\Trending.svg',
                'active' => 1,
            ]
        ]);
    }
}
