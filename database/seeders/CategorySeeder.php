<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $data = [
        ['name' => 'Fashion'],
        ['name' => 'Food'],
        ['name' => 'Cosmetics']
        ];

        foreach($data as $d){
            $category = new Category;
            $category->name = $d['name'];
            $category->save();
        }
    }
}
