<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            [ 
                'id'=>1,
                'full_name'=>'Administrator',
                'email'=>'admin@gmail.com', 
                'password'=>bcrypt('123456'),
                'address'=>'Hà Nội',
                'phone' => '0395954444',
                'level' => 1
            ]
        ]);
    }
}
