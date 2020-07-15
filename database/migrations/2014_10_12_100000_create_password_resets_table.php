<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     */
    /* Function up() allows to execute current migration(table 'password_resets' with three columns) on database */
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email', 191)->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    /* Function down() allows to drop 'password_resets' table on rollback command(when the current migration is the last one executed) */
    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
}