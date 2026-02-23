<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_permissions', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            
            $table->bigInteger('id')->autoIncrement()->unsigned();
            $table->string('group_permission_id', 48)->unique();
            $table->string('group_id', 48)->index();
            $table->string('permission_id', 48)->index();
            $table->unique(['group_id', 'permission_id']);

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
        Schema::dropForeign('group_permissions_group_id_foreign');
        Schema::dropForeign('group_permissions_permission_id_foreign');

        Schema::dropIfExists('group_permissions');
        
    }
}
