<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();
        DB::table('users')->delete();
        User::create(
            array(
                'email' => 'keldenar@gmail.com',
                'first_name' => 'Bret',
                'last_name'  => 'Combast',
                'link' => 'keldenar',
                'password' => Hash::make('killian2469')
            )
        );
        User::create(
            array(
                'email' => 'judybat13@gmail.com',
                'first_name' => 'Judy',
                'last_name'  => 'Combast',
                'link' => 'nynaeve',
                'password' => Hash::make('killian2469')
            )
        );
    }
}
