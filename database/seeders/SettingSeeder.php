<?php

namespace Database\Seeders;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = new Setting([
            'name' => 'Transfer Bca',
            'is_active' => 'TERKIRIM',
        ]);

        $settings->save();
    }
}