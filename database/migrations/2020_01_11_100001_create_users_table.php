<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                
                $table->bigInteger('id')->autoIncrement()->unsigned();
                $table->string('user_id', 48)->unique();
                $table->string('first_name', 48);
                $table->string('second_name', 48);
                $table->string('last_name', 48);
                $table->string('username', 48);
                $table->string('social_name', 48);
                $table->string('social_id');
                $table->string('email');
                $table->string('phone');
                $table->string('password');
                $table->tinyInteger('role')->length(1)->index();
                $table->string('profile_url');
                $table->string('token');
                $table->string('remember_token');
                $table->tinyInteger('status')->length(1)->index();
                $table->dateTime('created_at');
                $table->dateTime('updated_at');
                $table->dateTime('deleted_at')->nullable()->default(null);
                $table->string('email_verified_at');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
