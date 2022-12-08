<?php

use Illuminate\Database\Seeder;

class ProduitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 9; $i++) {
            DB::table('produits')->insert([
                'labelProd' => 'patates'.$i,
                'descProd' => 'sac de patates'.$i,
                'prixProd' => $i,
                'cheminPhotoProd' => 'https://i.pinimg.com/originals/c5/2f/c9/c52fc99b6fecac8e6bc20a8ccc83a7e1.jpg',
                'quantiteProd' => $i,
                'unite_id' => $i,
                'commerce_id' => 146,
            ]);
        }

    }
}
