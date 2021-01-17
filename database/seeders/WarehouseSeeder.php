<?php

namespace Database\Seeders;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $warehouse = new Warehouse([
            'name' => 'Runag Tengah',
            'address' => 'Di dalam rumah',
            'thumbnail' => 'default.png',
        ]);        

        $warehouse->save();

        $warehouse = new Warehouse([
            'name' => 'Gudang Belakang',
            'address' => 'Di belakang rumah',
            'thumbnail' => 'default.png',
        ]);        

        $warehouse->save();

        $warehouse = new Warehouse([
            'name' => 'Gudang Depan',
            'address' => 'Di depan rumah',
            'thumbnail' => 'default.png',
        ]);        

        $warehouse->save();

        $warehouse = new Warehouse([
            'name' => 'Gudang Samping',
            'address' => 'Di samping rumah',
            'thumbnail' => 'default.png',
        ]);        

        $warehouse->save();
    }
}
