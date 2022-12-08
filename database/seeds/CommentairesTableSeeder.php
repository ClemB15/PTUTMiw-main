<?php

use Illuminate\Database\Seeder;

class CommentairesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 4; $i++) {
            DB::table('commentaires')->insert([
                'note' => 3,
                'commentaireAvis' => ' :) patates'.$i,
                'user_id' => $i,
                'commerce_id' => 146
            ]);
        }
    }
}
