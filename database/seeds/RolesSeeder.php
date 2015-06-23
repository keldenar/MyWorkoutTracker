<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();
        DB::table('roles')->delete();
        InternalType::create([ 'name' => 'Laps' ]);
    }
}
