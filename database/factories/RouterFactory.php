<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\model\Router;
use Faker\Generator as Faker;

$factory->define(Router::class, function (Faker $faker) {
    return [
        'sap_id' => $faker->unique()->regexify('[A-Za-z0-9]{18}'),
        'host_name' => $faker->unique()->domainName,
        'ip_address' => $faker->unique()->ipv4,
        'mac_address' => $faker->unique()->macAddress
    ];
});
