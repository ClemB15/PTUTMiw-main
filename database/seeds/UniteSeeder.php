<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniteSeeder extends Seeder
{

    public function run()
    {
        DB::table('unites')->insert([
            'libelleUnit' => 'Kg'
        ]);
        DB::table('unites')->insert([
            'libelleUnit' => 'G'
        ]);
        DB::table('unites')->insert([
            'libelleUnit' => 'Lot'
        ]);
        DB::table('unites')->insert([
            'libelleUnit' => 'Litre'
        ]);
        DB::table('unites')->insert([
            'libelleUnit' => 'Unité'
        ]);
        DB::table('unites')->insert([
            'libelleUnit' => 'M'
        ]);
        DB::table('unites')->insert([
            'libelleUnit' => 'Cm'
        ]);
    }
}
