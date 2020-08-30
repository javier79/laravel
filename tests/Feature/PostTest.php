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

    public function testStoreValid()
    {
        //Arrange
        /*$params refers to parameters. Below associative array wants to specify the scenario where 
        key 'title' and 'content' references a string that comply with the validation for both text fields.
        values 'Valid title' and 'At least 10 characters' are set arbitraryly to model string lenght */
        $params=[
            'title'=> 'Valid title',
            'content'=>'At least 10 characters'
        ];
        /*Here we are simulating an http request in the browser as if a form have been submitted,
        with the paramters requiring and modeling the state of the submitted data(validated/correct)*/
        //Act
        $this->post('/posts', $params)/*Redirects to the /post associated to $params values.post() verb
        is used as we are simulating a form request, also needed to access assertStatus()/assertSessionHas()*/
        //Assert
        ->assertStatus(302)//Checking for successful redirect(302 is http code for successful redirect)
        ->assertSessionHas('status');/*test key name 'status' is present in the session found at
        PostController($request->session()->flash('status', 'Blog post was updated!')*/
        $this->assertEquals(session('status'), 'Blog post was created!');/*test if added/flash message text display as intended, session('status') reads 'status' value and compares to second parameter */ 
    }
}

//Reminder:In each test we are running all migrations
