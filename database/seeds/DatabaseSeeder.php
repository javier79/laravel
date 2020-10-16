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
        if ($this->command->confirm('Do you want to refresh the database?')) {/*confirm() let us put a question 
            for users to interact with on terminal. It is default value for an answer is no(false) meaning that 
            if user press enter it won't execute any action */
            $this->command->call('migrate:refresh');//It is as if this action were run on terminal
            $this->command->info('Database was refreshed');//info()displays message to user but user do not interact with it
        }

        $this->call([
            UsersTableSeeder::class, 
            BlogPostsTableSeeder::class, 
            CommentsTableSeeder::class
        ]);
    }
}

