<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Constants;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'address' => 'Banyuwangi',
            'phone' => '082220093197',
            'role' => Constants::$USER_ROLE_SUPER_ADMIN,
            'password' => bcrypt('superadmin@@'),
            'thumbnail' => '',
        ]);

        $user->save();

        $user = new User([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'address' => 'Banyuwangi',
            'phone' => '081234968470',
            'role' => Constants::$USER_ROLE_ADMIN,
            'password' => bcrypt('admin@@'),
            'thumbnail' => 'ktp.jpg',
        ]);        

        $user->save();

        

    }
}
