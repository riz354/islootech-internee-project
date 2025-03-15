<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labels = ["bugs","questions","enhancement"];
        foreach($labels as $lbl){
            Label::query()->create([
                "label_name"=>$lbl
            ]);
        }
    }
}
