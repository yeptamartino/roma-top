<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\Catalog;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        
        
        $category = Category::all()->first();
        $catalog = new Catalog([
            'name' => 'Bantal Doraemon',
            'capital_price' => '200000',
            'selling_price' => '250000',
            'description' => 'Bantal Doraemon Warna Biru',
            'thumbnail' => 'default.png',
            'category_id' => $category->id,
        ]);

        $catalog->save();

        $category = Category::all()->first();
        $catalog = new Catalog([
            'name' => 'Bantal Hello Kitty',
            'capital_price' => '200000',
            'selling_price' => '250000',
            'description' => 'Bantal Hello Kitty Warna Pink',
            'thumbnail' => 'default.png',
            'category_id' => $category->id,
        ]);

        $catalog->save();

        $category = Category::all()->first();
        $catalog = new Catalog([
            'name' => 'Banta Naruto',
            'capital_price' => '200000',
            'selling_price' => '250000',
            'description' => 'Bantal Naruto Warna Biru',
            'thumbnail' => 'default.png',
            'category_id' => $category->id,
        ]);

        $catalog->save();
    }
}
