<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('states')->delete();
        $states = array (
            array('id' => '1',
                  'country_id' => '1',
                  'name' => 'Yangon'),
        );
        DB::table('states')->insert($states);
    }
}
