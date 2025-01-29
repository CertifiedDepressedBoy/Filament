<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->delete();
        $citys = array (
            array('id' => 1,
                'state_id' => 1,
                'name' => 'Yangon'
            )
        );
        DB::table('cities')->insert($citys);
    }
}
