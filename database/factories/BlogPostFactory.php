<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BlogPost;
use Faker\Generator as Faker;

$factory->define(BlogPost::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence(10),//faker va a generar oracion de 10 palabras
        'content'=> $faker->paragraphs(5, true)/*faker will generate 5 paragraphs, normally it
        returns an array but as we are not processing anything we want it returned as text 
        and set second parameter to true for that matter.*/
    ];
});
/*This state let us overwrite the definitions on private function createDummyBlogPost():BlogPost
(from PostTest.php). 'new-title'is how we named the state*/ 
$factory->state(App\BlogPost::class, 'new-title', function (Faker $faker){
    return [
     'title' => 'New title',
     'content' => 'Content of the blog post'// Commented to demonstrate how the factory then generates dumy data when there is not a directive like this to overwrite factory
     /*This properties values will always be as defined here, and will not store dummy data */
    ];
});