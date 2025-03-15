<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $priority = array("High", "Medium", "Low");

        foreach ($priority as $pr) {
            Priority::query()->create([
                'priority'=>$pr
            ]);
        };
    }
}
