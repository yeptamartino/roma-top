<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\Catalog;
use App\Models\CatalogPrice;
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
        
        
        
        $category = Category::all()->last();
        $catalog = new Catalog([
            'name' => 'Bantal Dacron',
            'capital_price' => '200000',
            'description' => 'Bantal Dacron',
            'thumbnail' => 'default.png',
            'category_id' => $category->id,
        ]);

        $catalog->save();


        $catalog->prices()->saveMany([
          new CatalogPrice([
            'name' => 'Harga Jual 1',
            'price' => 250000
          ])
        ]);

        $catalog = new Catalog([
            'name' => 'Guling Dacron',
            'capital_price' => '200000',
            'description' => 'Guling Dacron',
            'thumbnail' => 'default.png',
            'category_id' => $category->id,
        ]);

        $catalog->save();

        $catalog->prices()->saveMany([
          new CatalogPrice([
            'name' => 'Harga Jual 1',
            'price' => 250000
          ])
        ]);

        $catalog = new Catalog([
            'name' => 'Bantal Cinta Dacron',
            'capital_price' => '200000',
            'description' => 'Bantal Cinta Dacron',
            'thumbnail' => 'default.png',
            'category_id' => $category->id,
        ]);

        $catalog->save();

        $catalog->prices()->saveMany([
          new CatalogPrice([
            'name' => 'Harga Jual 1',
            'price' => 250000
          ])
        ]);

        $catalog = new Catalog([
            'name' => 'Bantal Sofa Dacron',
            'capital_price' => '200000',
            'description' => 'Bantal Sofa Dacron',
            'thumbnail' => 'default.png',
            'category_id' => $category->id,
        ]);

        $catalog->save();

        $catalog->prices()->saveMany([
          new CatalogPrice([
            'name' => 'Harga Jual 1',
            'price' => 250000
          ])
        ]);
        
        $catalog = new Catalog([
            'name' => 'Bantal Lantai Dacron',
            'capital_price' => '200000',
            'description' => 'Bantal Lantai Dacron',
            'thumbnail' => 'default.png',
            'category_id' => $category->id,
        ]);

        $catalog->save();

        $catalog->prices()->saveMany([
          new CatalogPrice([
            'name' => 'Harga Jual 1',
            'price' => 250000
          ])
        ]);
        
        $catalog = new Catalog([
            'name' => 'Bantal Lantai Dacron',
            'capital_price' => '200000',
            'description' => 'Bantal Lantai Dacron',
            'thumbnail' => 'default.png',
            'category_id' => $category->id,
        ]);

        $catalog->save();

        $catalog->prices()->saveMany([
          new CatalogPrice([
            'name' => 'Harga Jual 1',
            'price' => 250000
          ])
        ]);
    }
}
