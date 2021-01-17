<?php

namespace Database\Seeders;
use App\Models\Catalog;
use App\Models\Warehouse;
use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catalog = Catalog::all()->first();
        $warehouse = Warehouse::all()->first();
        $stock = new Stock([
            'total' => '150',
            'catalog_id' => $catalog->id,
            'warehouse_id' => $warehouse->id,
        ]);

        $stock->save();
    }
}
