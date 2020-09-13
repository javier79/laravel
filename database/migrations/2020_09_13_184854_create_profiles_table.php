<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('author_id')->unique();//creates column 'author_id'
            $table->foreign('author_id')->references('id')->on('authors');/*'author_id' will be the foreign key
            and will reference column 'id' on 'authors' table. While a primary key may exist on its own, a foreign key
            must always reference to a primary key somewhere. The original table containing the primary key is the 
            parent table (also known as referenced table). This key can be referenced by multiple foreign keys from 
            other tables, known as “child” tables.*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
