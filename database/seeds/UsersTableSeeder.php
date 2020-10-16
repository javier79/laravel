<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount = max((int)$this->command->ask('How many users would you like?', 20), 1);/*We are asking
        the user the number users to be generated, it is cast as an int as what is expected
        is an integer number as user input and its set 20 as default value
        if no input is entered. Due at all times we need at leat one user to be created
        for BlogPostsTableSeeder to be able to generate blogposts we are adding max() and \
        1 as params what it does is that if user enters 0 or an invalid entry at least it will create 
        1 user. */

        factory(App\User::class)->states('john-doe')->create();//call state on UserFactory

        factory(App\User::class, $usersCount)->create();/*generates(check UserFactory.php) and 
        adds the number imput by user*/

        //dd(get_class($doe),get_class($else));

        //$users = $else->concat([$doe]);//we don't need this now
    }
}
