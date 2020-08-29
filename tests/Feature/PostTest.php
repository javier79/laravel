<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\WithFaker;tutorial not using them at the time
use Tests\TestCase;
use App\BlogPost;

class PostTest extends TestCase
{
    use RefreshDatabase;//generate empty DB before testExample() execute, that way there will be no data to affect our testing
   
    public function testNoBlogPostsWhenNothingInDatabase()//testing that 'No blog post yet!' string shows up in our page
    {
        $response = $this->get('/posts');//fetch page store it in $response

        $response->assertSeeText('No blog post yet!');
    }

    public function testSee1BlogPostWhenThereIs1()
    {
        //Arrange part(see cheat sheet), creating new model and asignin values to title and content columns
        $post = new BlogPost();
        $post->title = 'New title';
        $post->content = 'Content of blog post';
        $post->save();

        //Act
        $response = $this->get('/posts');

        //Assert
        $response->assertSeeText('New title');

        $this->assertDatabaseHas('blog_posts', [//check table 'blog_post' if attribute title contains value 'New title'
            'title'=> 'New title'
        ]);


    }
}

//Reminder:In each test we are running all migrations
