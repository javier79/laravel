<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCascadeDeleteToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            if (!env('DB_CONNECTION') === 'sqlite_testing'){
            $table->dropForeign(['blog_post_id']);/*deleting foreignkey first putting
            the column name on brackets instruct the system to look for the name of the foreignkey
            associated to the column of that name*/
            }

            
            $table->foreign('blog_post_id')//This foreign key difinition(meaning from this line to onDelete()) responds to be able to implement onDelete()
            ->references('id')
            ->on('blog_posts')
            ->onDelete('cascade');//At DB level if a blogpost(parent) is deleted also the comments associated to it will be deleted.
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['blog_post_id']);
            $table->foreign('blog_post_id')
                ->references('id')
                ->on('blog_posts');
            //To bring it back to its original state we use same code as in up() but without the onDelete()    
            
        });
    }
}
