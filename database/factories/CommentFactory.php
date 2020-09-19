<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;
/*Comment::class(references Comment class(table)) and second paramenter is a closure that receive a Faker
instance*/
$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content'=>$faker->text/*'content' is our column where Faker will generate some text
        when we use tinker command and on test command genarate dummy text that we don't display as it runs
        in our sqlite DB for testing */
    ];
});