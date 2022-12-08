<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Admin',
            'slug' => 'admin',
        ]);
        DB::table('roles')->insert([
            'name' => 'Moderateur',
            'slug' => 'moderateur',
        ]);
        DB::table('roles')->insert([
            'name' => 'Responsable Commerce',
            'slug' => 'responsable-commerce',
        ]);
        DB::table('roles')->insert([
            'name' => 'User',
            'slug' => 'user',
        ]);
    }
}
