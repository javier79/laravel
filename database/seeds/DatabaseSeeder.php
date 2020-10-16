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
        $this->call([
            UsersTableSeeder::class, //method call to UsersTableSeeder.php
            BlogPostsTableSeeder::class, 
            CommentsTableSeeder::class]);


    }

}
