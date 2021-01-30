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
            'name' => 'KOMPOSISI',
        ]);        

        $category->save();
        $category = new Category([
            'name' => 'BANTAL',
        ]);        

        $category->save();

        $category = new Category([
            'name' => 'GULING',
        ]);        

        $category->save();

        $category = new Category([
            'name' => 'KASUR',
        ]);        

        $category->save();

        $category = new Category([
            'name' => 'SPREI ',
        ]);        

        $category->save();

        $category = new Category([
            'name' => 'SPRING BED',
        ]);        

        $category->save();
    }
}
