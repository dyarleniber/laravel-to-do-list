<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;
use App\User;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'user_id' => factory(User::class),
    ];
});
