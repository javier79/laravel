<?php

use Illuminate\Database\Seeder;

class BlogPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogCount = (int)$this->command->ask('How many blog posts would you like?', 50);
        
        $users = App\User::all();

        /*The block of code below creates(but don't save, we are not using create() as we need 
        to assign each model a user_id in order for each to be saved ) 50 blogposts models. 
        each() let us iterate over each model. use ($users) due we need $users var data 
        but it is out of closure function and scope we employ USE. PLEASE CHECK NOTEBOOK II
        ON BRANCH MODEL RELATION FACTORY INSIDE SEEDER and INDIVIDUAL SEEDERS CLASSES*/
        factory(App\BlogPost::class, $blogCount)->make()->each(function($post) use ($users) {
            $post->user_id = $users->random()->id;/*assigns a random id(from users table column)
             to user_id column in blogposts table, REMEMBER THERE MUST BE AT LEAST 1 USER CREATED 
             */
            $post->save();//saves
        });
    }
}
