<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [
        //
    ];
});
/*Calls for the previously created Author instance and pass it to closure function(callback)
as $author and previously created instance of Faker as $faker*/
$factory->afterCreating(App\Author::class, function ($author, $faker)
{
    $author->profile()->save(factory(App\Profile::class)->make());//access relation, instantiate object and save, create(make()).
});