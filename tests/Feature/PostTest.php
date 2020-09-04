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
        $post = $this->createDummyBlogPost(); /*REMEMBER THIS FUNCTION LIVES public function testDelete()
        THIS WAS DONE DUE WE REPEATED THAT BLOCK OF CODE(INSTANCING A BlogPost Object) in different functions here on 
        the same class*/

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
        PostController($request->session()->flash('status', 'Blog post was updated!'), 'status' will be present
        only when validation is ok*/
        $this->assertEquals(session('status'), 'Blog post was created!');/*test if added/flash message text display 
        as intended, session('status') reads 'status' value and compares to second parameter */ 
    }

    public function testStoreFail()
    {
        $params = [
            'title'=>'x',
            'content'=>'x'
        ];

        $this->post('/posts', $params)
        ->assertStatus(302)
        ->assertSessionHas('errors');//errors is another session variable as 'status'.

        $messages = session('errors')->getMessages();/*variable session is present and getMessages fetch the errors
        and store em at $messages*/

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');/*test if message text 
        display as intended, $messages['title'][0](check messages in SECOND TERMINAL RUN AT THE END OF PAGE to see from
        where did we get that assoc array) content($messages['title'][0]) is tested against the text on second parameter. */
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');


        /*dd($messages->getMessages());***prints variable sessions errors, that session() read in the line above,
        THIS LINE WAS USED TO FIND OUT THROUGH TERMINAL HOW TO ACCESS ERRORS MESSAGES READ BELOW*/
    }


//Reminder:In each test we are running all migrations
//TERMINAL RUN  dd($messages)
/*PS C:\xampp\htdocs\laravel> ./vendor/bin/phpunit
PHPUnit 8.5.6 by Sebastian Bergmann and contributors.

..... ..Illuminate\Support\ViewErrorBag^ {#4107 ***ViewErrorBag is an object***
  #bags: array:1 [***#bags is an object property which is also an array***
    "default" => Illuminate\Support\MessageBag^ {#4108***To access #messages property(and it's content) 
        we must search MessageBag on the API and it's function getMessages()***
      #messages: array:2 [
        "title" => array:1 [***"title" this is from the rules() in StorePost.php
          0 => "The title must be at least 5 characters."
        ]
        "content" => array:1 [
          0 => "The content must be at least 10 characters."
        ]
      ]
      #format: ":message"
    }
  ]
}*/


//SECOND TERMINAL RUN AFTER  dd($messages->getMessages());
/*PS C:\xampp\htdocs\laravel> ./vendor/bin/phpunit
PHPUnit 8.5.6 by Sebastian Bergmann and contributors.

..... ..array:2 [
  "title" => array:1 [
    0 => "The title must be at least 5 characters."
  ]
  "content" => array:1 [
    0 => "The content must be at least 10 characters."
  ]
]*/


  public function testUpdateValid()
  {
    $post = $this->createDummyBlogPost(); /*REMEMBER THIS FUNCTION LIVES public function testDelete()
    THIS WAS DONE DUE WE REPEATED THAT BLOCK OF CODE(INSTANCING A BlogPost Object) in different functions here on 
    the same class*/

  $this->assertDatabaseHas('blog_posts', [
    'title' => 'New title',
    'content'=> 'Content of blog post'
   ]);/*(EDIT) WE USED INSTEAD:  [
    'title' => 'New title',
    'content'=> 'Content of blog post'
   ]*/
   /*DUE SEEMS IN MY LARAVEL VERSION assertDatabaseHas() DOES NO WORKS WITH ARRAY OF ARRAYS($post->toArray())
   HERE WE ARE ASSERTING THAT THE CREATED BLOGPOST EXIST*/

   $params=[
    'title'=> 'A new named title',
    'content'=>'Content was changed'
];

   $this->put("/posts/{$post->id}", $params)/*/posts/{$post->id} as per Route:list we are simulating a form for 
   updating(put request) or modified the blogpost that we created at the top of this testUpdateValid() and passing valid params*/
        ->assertStatus(302)//A successful redirect is expected
        ->assertSessionHas('status');//variable 'status' is expected to be in session

        $this->assertEquals(session('status'), 'Blog post was updated!');
        $this->assertDatabaseMissing('blog_posts', [
          'title' => 'New title',
          'content'=> 'Content of blog post'
         ]);//Asserting that the original blogpost could not be found(as it was successfully updated)

         $this->assertDatabaseHas('blog_posts', [
          'title' => 'A new named title',
          'content'=> 'Content was changed'
         ]);//Asserting that the new 'title' and 'content' are present.
  }

  public function testDelete()
  {
    $post = $this->createDummyBlogPost();

    $this->assertDatabaseHas('blog_posts', [
      'title' => 'New title',
      'content'=> 'Content of blog post'
     ]);//Asserting that blogpost was store.
     //REMEMBER THAT TUTORIAL USED $this->assertDatabaseHas('blog_posts', $post->toArray())

    $this->delete("/posts/{$post->id}")/*delete verb does not need any parameters, only the
    resource url*/
         ->assertStatus(302)//A successful redirect is expected
         ->assertSessionHas('status');//variable 'status' is expected to be in session

    $this->assertEquals(session('status'), 'Blog post was deleted!');//Assert the displayed message

    $this->assertDatabaseMissing('blog_posts',[
      'title' => 'New title',
      'content'=> 'Content of blog post'
     ]);//Asserting that the original blogpost could not be found(as it was successfully deleted)
     //REMEMBER THAT TUTORIAL USED $this->assertDatabaseMissing('blog_posts', $post->toArray())
  }
    private function createDummyBlogPost():BlogPost/*function returns a BlogPost instance
    THIS FUNCTION IS USED BY SEVERAL FUNCTIONS INSIDE THE CLASS PostTest, that required to instance a model*/
    {
    $post = new BlogPost();
    $post->title = 'New title';
    $post->content = 'Content of blog post';
    $post->save();  

    return $post;
    }
 
  
}