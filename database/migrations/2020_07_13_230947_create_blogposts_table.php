<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogpostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //Function up() specified what changes must be done to database schema
    public function up()
    {   /*From Schema object, create('tablename', closure function(Blueprint object instance is named $table)*/
        Schema::create('blogposts', function (Blueprint $table) {
            //Blueprint methods for creating columns
            $table->increments('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    /* Function down() allows to drop 'blogpost' table on rollback command(when the current migration is the last one executed) */
    public function down()
    {
        Schema::dropIfExists('blogposts');
    }
}
