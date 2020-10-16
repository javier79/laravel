<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $posts = App\BlogPost::all();

        if ($posts->count() === 0){
            $this->command->info('There are no blog posts, so no comments will be added');
            return;/*Without this statement the flow will go to next statement below,
            if the work flow enters the IF, the return statement would no let the program 
            to resume executing the statements below, ending execution.*/
        }
        $commentsCount = (int)$this->command->ask('How many comments would you like?', 150);
         /*The block of code below creates(but don't save, we are not using create() as we need 
        to assign each model a blog_post_id in order for each to be saved ) 150 comments models. 
        each() let us iterate over each model. use ($posts) due we need $posts var data 
        but it is out of closure function and scope we employ USE. PLEASE CHECK NOTEBOOK II
        ON BRANCH MODEL RELATION FACTORY INSIDE SEEDER and INDIVIDUAL SEEDERS CLASSES*/
        factory(App\Comment::class, $commentsCount)->make()->each(function ($comment) use ($posts) {
            $comment->blog_post_id = $posts->random()->id;
            $comment->save();
        });
    }
}
