<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(WarehouseSeeder::class);
        $this->call(CatalogSeeder::class);
        $this->call(StockSeeder::class);
        $this->call(SettingSeeder::class);
    }
}
