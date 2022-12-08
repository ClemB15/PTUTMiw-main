<?php

use App\Categorie;
use App\SousCategorie;
use App\User;
use App\Ville;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $faker = Faker::create();
        $code = substr(str_replace(' ','',$faker->firstNameMale),0,3).date('dmyHi');
        DB::table('commerces')->insert([
            'nomCom' => "$faker->firstNameMale",
            'ad1Com' => '05000',
            'latCom' => 44.569396,
            'longCom' => 6.103322,
            'telCom' => "$faker->phoneNumber",
            'mailCom' => "$faker->email",
            'descCom' => "$faker->text()",
            'siretCom' => $faker->randomDigit,
            'siteCom' => 'google.fr',
            'etatCom' => 1,
            'dateCreaCom' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'codeCom' => "$code",
            'categorie_id' => $faker->numberBetween(1,4),
            'user_id' => 1,
            'ville_id' => 1819,
        ]);
        DB::table('commerces')->insert([
            'nomCom' => "$faker->firstNameMale",
            'ad1Com' => '05000',
            'latCom' => 44.561003,
            'longCom' => 6.082961,
            'telCom' => "$faker->phoneNumber",
            'mailCom' => "$faker->email",
            'descCom' => "$faker->text()",
            'siretCom' => $faker->randomDigit,
            'siteCom' => 'google.fr',
            'etatCom' => 1,
            'dateCreaCom' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'codeCom' => "$code",
            'categorie_id' => $faker->numberBetween(1,4),
            'user_id' => 1,
            'ville_id' => 1819,
        ]);
        DB::table('commerces')->insert([
            'nomCom' => "$faker->firstNameMale",
            'ad1Com' => '05000',
            'latCom' => 44.554450,
            'longCom' => 6.07288,
            'telCom' => "$faker->phoneNumber",
            'mailCom' => "$faker->email",
            'descCom' => "$faker->text()",
            'siretCom' => $faker->randomDigit,
            'siteCom' => 'google.fr',
            'etatCom' => 1,
            'dateCreaCom' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'codeCom' => "$code",
            'categorie_id' => $faker->numberBetween(1,4),
            'user_id' => 1,
            'ville_id' => 1819,
        ]);
        DB::table('commerces')->insert([
            'nomCom' => "$faker->firstNameMale",
            'ad1Com' => '05000',
            'latCom' => 44.543,
            'longCom' => 6.0586,
            'telCom' => "$faker->phoneNumber",
            'mailCom' => "$faker->email",
            'descCom' => "$faker->text()",
            'siretCom' => $faker->randomDigit,
            'siteCom' => 'google.fr',
            'etatCom' => 1,
            'dateCreaCom' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'codeCom' => "$code",
            'categorie_id' => $faker->numberBetween(1,4),
            'user_id' => 1,
            'ville_id' => 1819,
        ]);
        DB::table('commerces')->insert([
            'nomCom' => "$faker->firstNameMale",
            'ad1Com' => '05000',
            'latCom' => 44.62708,
            'longCom' => 6.081410,
            'telCom' => "$faker->phoneNumber",
            'mailCom' => "$faker->email",
            'descCom' => "$faker->text()",
            'siretCom' => $faker->randomDigit,
            'siteCom' => 'google.fr',
            'etatCom' => 1,
            'dateCreaCom' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'codeCom' => "$code",
            'categorie_id' => $faker->numberBetween(1,4),
            'user_id' => 1,
            'ville_id' => 1819,
        ]);
        DB::table('commerces')->insert([
            'nomCom' => "$faker->firstNameMale",
            'ad1Com' => '05000',
            'latCom' => 44.5966,
            'longCom' => 6.0783,
            'telCom' => "$faker->phoneNumber",
            'mailCom' => "$faker->email",
            'descCom' => "$faker->text()",
            'siretCom' => $faker->randomDigit,
            'siteCom' => 'google.fr',
            'etatCom' => 1,
            'dateCreaCom' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'codeCom' => "$code",
            'categorie_id' => $faker->numberBetween(1,4),
            'user_id' => 1,
            'ville_id' => 1819,
        ]);
        DB::table('commerces')->insert([
            'nomCom' => "$faker->firstNameMale",
            'ad1Com' => '05000',
            'latCom'=> 44.579,
            'longCom' => 6.106,
            'telCom' => "$faker->phoneNumber",
            'mailCom' => "$faker->email",
            'descCom' => "$faker->text()",
            'siretCom' => "$faker->randomDigit",
            'siteCom' => 'google.fr',
            'etatCom' => 1,
            'dateCreaCom' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'codeCom' => "$code",
            'categorie_id' => $faker->numberBetween(1,4),
            'user_id' => 1,
            'ville_id' => 1819,
        ]);
    }
}
