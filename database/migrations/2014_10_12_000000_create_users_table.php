 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //This is a default migration created with the project
    /* Function up() allows to execute current migration(table 'users' with eight columns 
    as timestamp(displays two columns created_at and updated_at) on database */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email', 191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    /* Function down() allows to drop 'users' table on rollback command(when the current migration is the last one executed) */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
