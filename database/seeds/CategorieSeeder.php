<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'libCat' => 'Restaurant',
            'cheminMarkerCat' => 'restaurant',
        ]);
        DB::table('categories')->insert([
            'libCat' => 'Fleuriste',
            'cheminMarkerCat' => 'fleuriste',
        ]);
        DB::table('categories')->insert([
            'libCat' => 'Librairie',
            'cheminMarkerCat' => 'livres',
        ]);
        DB::table('categories')->insert([
            'libCat' => 'Animalerie',
            'cheminMarkerCat' => 'animalerie',
        ]);

    }
}
