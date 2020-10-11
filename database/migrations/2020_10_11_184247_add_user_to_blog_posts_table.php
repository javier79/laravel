<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserToBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_posts', function (Blueprint $table) {

            /*$table->unsignedInteger('user_id')->nullable();/*due we already have some records
            that won't have nothing in user_id and due the field can't be empty
            nullable would asign the value null to those existing record prior to
            the creation of the column, we ended taking out the nullable
            due we refresh DB and there will be no prior records*/
            if (env('DB_CONNECTION') === 'sqlite_testing') {
                $table->unsignedInteger('user_id')->default('0');
            } else {
                $table->unsignedInteger('user_id');
            }
            $table->foreign('user_id')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);/*drop foreign key first, brackets 
            tell the system to look for a foreignkey created under user_id, and i
            will work out on it is own the name of the foreign key, meaning it
            won't look after a foreign key named user_id but instead*/
            $table->dropColumn('user_id');
        });
    }
}
