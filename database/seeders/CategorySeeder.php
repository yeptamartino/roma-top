<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category([
            'name' => 'Bantal',
        ]);        

        $category->save();

        $category = new Category([
            'name' => 'Guling',
        ]);        

        $category->save();

        $category = new Category([
            'name' => 'Kasur',
        ]);        

        $category->save();

        $category = new Category([
            'name' => 'Sprei ',
        ]);        

        $category->save();

        $category = new Category([
            'name' => 'Spring Bed',
        ]);        

        $category->save();
    }
}
