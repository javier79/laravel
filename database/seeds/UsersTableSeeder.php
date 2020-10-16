<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->states('john-doe')->create();//call state on UserFactory

        factory(App\User::class, 20)->create();/*generates(check UserFactory.php) and add 20 records, we keep
        the hard coded record we create in the run()*/

        //dd(get_class($doe),get_class($else));

        //$users = $else->concat([$doe]);//we don't need this now
    }
}
