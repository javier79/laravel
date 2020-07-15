<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleContentToBlogpostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogposts', function (Blueprint $table) {
            $table->string('title');//string() is equivalent of VARCHAR(255)
            $table->text('content');//text() is equivalent of TEXT
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    /* Function down() allows to drop 'title' and 'content' columns on rollback command(when the current migration is the last one executed) */
    public function down()
    {
        Schema::table('blogposts', function (Blueprint $table) {
            $table->dropColumn(['title', 'content']);/*employing an array, let us use a single line syntax or 
            we may use two lines as in up()*/
        });
    }
}
