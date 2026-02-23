<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_groups', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            
            $table->bigInteger('id')->autoIncrement()->unsigned();
            $table->string('user_group_id', 48)->unique();
            $table->string('user_id', 48)->index();
            $table->string('group_id', 48)->nullable()->default(null)->index();
            $table->string('permission_id', 48)->nullable()->default(null)->index();

            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('group_id')->references('group_id')->on('groups');
            $table->foreign('permission_id')->references('permission_id')->on('permissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign('user_groups_user_id_foreign');
        Schema::dropForeign('user_groups_group_id_foreign');
        Schema::dropForeign('user_groups_permission_id_foreign');

        Schema::dropIfExists('user_groups');
    }
}
