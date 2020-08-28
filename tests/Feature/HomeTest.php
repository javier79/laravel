<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase; tutorial not using it at the time
//use Illuminate\Foundation\Testing\WithFaker; tutorial not using it at the time
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePageIsWorkingCorrectly()/*This test will look for the displaying of certain 
    text in our home page(Function name was edited from testExample default name to testHomePageIsWorkingCorrectly())*/
    {
        $response = $this->get('/');//fetch home page

        $response->assertSeeText('Welcome to Laravel!');//text to be tested

        $response->assertSeeText('This is the content of the main page!');//text to be tested
    }

    public function testContactPageIsWorkingCorrectly()//function added manually
    {
        $response = $this->get('/contact');

        $response->assertSeeText('Contact');//text to be tested

        $response->assertSeeText('Hello this is contact!');//text to be tested
    }
}
