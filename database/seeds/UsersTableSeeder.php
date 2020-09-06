<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_array = array(
            array(
                'name' => "Nabina Khadka",
                'email' => "admin@ecom.com",
                'password' => Hash::make('admin123'),
                'role' => "admin",
                'status' => "active",
            ),
            array(
                'name' => "seller",
                'email' => "seller@ecom.com",
                'password' => Hash::make('seller123'),
                'role' => "seller",
                'status' => "active",
            ),
            array(
                'name' => "customer",
                'email' => "customer@ecom.com",
                'password' => Hash::make('customer123'),
                'role' => "customer",
                'status' => "active",
            ),

        );

        DB::table('users')->insert($users_array);
    }
}
