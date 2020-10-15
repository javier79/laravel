<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        factory(App\User::class)->states('john-doe')->create();//call state on UserFactory

        factory(App\User::class, 20)->create();/*generates(UserFactory.php) and add 20 records, we keep
        the hard coded record we create in the run()*/
    }

}
