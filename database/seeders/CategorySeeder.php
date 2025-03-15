<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = ["uncategorized","billing/payment","technical questions"];
        foreach($category as $catg){
            Category::query()->create([
                "category_name"=>$catg
            ]);
        }
    }
}
