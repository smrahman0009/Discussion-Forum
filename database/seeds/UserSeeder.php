<?php

use App\User;
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
        User::create(
            [
                'name' => 'admin',
                'email'=> 'admin@gmail.com',
                'password'=>bcrypt('admin'),
                'admin' => '1',
                'avatar' => asset('avatars/avatar.png'),
            ]
            );

        User::create(
            [
                'name' => 'anik',
                'email' => 'anik@gmail.com',
                'password' => bcrypt('admin'),
                'avatar' => asset('avatars/avatar.png'),
            ]
        );    
    }
}
