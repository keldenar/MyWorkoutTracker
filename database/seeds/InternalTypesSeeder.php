<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\InternalType;

class InternalTypesTableSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();
        DB::table('internal_types')->delete();
        InternalType::create([ 'name' => 'Laps' ]);
        InternalType::create([ 'name' => 'Repetitions' ]);
        InternalType::create([ 'name' => 'Time' ]);
        InternalType::create([ 'name' => 'Weight' ]);
    }
}
