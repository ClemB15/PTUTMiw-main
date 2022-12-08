<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Ville;
use Faker\Provider\fr_FR\Address;



$factory->define(Ville::class, function (Faker $faker) {
    
    $data = "[[{'start_date':'2018-01-01','end_date':'2018-02-01','thing':'12'}],
    [{'start_date':'2018-03-01','end_date':'2018-04-01','thing':'8'}]]";
    return [
        'nomVil' => $faker->city,
        'cp' => Address::postcode(),
        'coordGps' => json_encode($data)
    ];
});
