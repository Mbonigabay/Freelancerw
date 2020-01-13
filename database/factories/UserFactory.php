<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),

        'address' => $faker->streetName,
//        'username' => $faker->userName,
        'description' => $faker->paragraphs(rand(2, 5), true),
        'telephone'=> $faker->phoneNumber,
        'rateOfPayment' => $faker->numberBetween(1000, 20000),
        'areaOfExpertise' => $faker->jobTitle,

        'sex' =>  $faker->randomElement($array = array('male','female')),
        'maritalStatus' =>  $faker->randomElement($array = array('single','married','divorce')),
        'educationBackground' => $faker->sentence,
        'skills' => $faker->jobTitle,
        'workExperience' => $faker->sentence,
//        'status' =>  $faker->randomElement(['Closed', 'Open']),
//        'verify',
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),

        'last_login_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'last_login_ip' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});
