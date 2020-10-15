<?php

use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB; not in use
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('users')->insert([
            //from UserFactory.php
            'name' => 'John Doe',
            'email' => 'john@laravel.test',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);AS AT THE TIME ONLY WANTED TO OVERWRITE NAME AND EMAIL 
        WE WILL USE THE LINE BELOW INSTEAD, TO SEE THE WHOLE BLOCK OF CODE
        PRESS ON THE THE DROP DOWN ARROW AT THE LEFT IN THE BEGINNING 
        OF THE BLOCK*/

        $doe=factory(App\User::class)->states('john-doe')->create();//call state on UserFactory

        $else=factory(App\User::class, 20)->create();/*generates(check UserFactory.php) and add 20 records, we keep
        the hard coded record we create in the run()*/

        //dd(get_class($doe),get_class($else));

        $users = $else->concat([$doe]);//it puts on a single collection the above 20 users created plus the hard coded model(John Doe)
       
        /*The block of code below creates(but don't save, we are not using create() as we need 
        to assign each model a user_id in order for each to be saved ) 50 blogposts models. 
        each() let us iterate over each model. use ($users) due we need $users var data 
        but it is out of closure function and scope we employ use. PLEASE CHECK NOTEBOOK II
        ON BRANCH MODEL RELATION FACTORY INSIDE SEEDER*/
        $posts = factory(App\BlogPost::class, 50)->make()->each(function($post) use ($users) {
            $post->user_id = $users->random()->id;//assigns a random id(from users table column) to user_id column in blogposts table
            $post->save();//saves
        });

        $comments = factory(App\Comment::class, 150)->make()->each(function ($comment) use ($posts) {
            $comment->blog_post_id = $posts->random()->id;
            $comment->save();
        });
    }

}
