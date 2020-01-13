<?php

use Faker\Generator as Faker;

$factory->define(App\Job::class, function (Faker $faker) {
    return [
        'name' =>$faker->sentence(),
        'jobBudget' =>$faker->randomDigit(),
        'description' => $faker->paragraphs(rand(2, 5), true),
        'skills' =>$faker->jobTitle(),
        'user_id' =>App\User::all()->random()->id,

//        'status' ,
        'location' => $faker->address,
        'deadline' =>  $faker->date($format = 'Y-m-d', $max = 'now'),
        'bidDeadline' =>  $faker->date($format = 'Y-m-d', $max = 'now'),
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});
