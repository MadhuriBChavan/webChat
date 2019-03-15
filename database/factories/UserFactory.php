<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'profile_image' => 'http://i.pravatar.cc/300',
        'email_verified_at' => now(),
        'password' => 'Maddy@96', // password
        'remember_token' => Str::random(10),
    ];
});


$factory->define(App\Message::class, function (Faker $faker) {
    do {
        $from = rand(1, 15);
        $to = rand(1, 15);
    } while ($from === $to);

    return [
        'from' => $from,
        'to' => $to,
        'text' => $faker->sentence
    ];
});

