<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForeignKeyPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('post_author')->references('user_id')->on('users');
            $table->foreign('post_type_id')->references('post_type_id')->on('post_types');
            $table->foreign('parent_post_id')->references('post_id')->on('posts');
            $table->foreign('location_id')->references('location_id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_post_author_foreign');
            $table->dropForeign('posts_post_type_id_foreign');
            $table->dropForeign('posts_parent_post_id_foreign');
            $table->dropForeign('posts_location_id_foreign');
        });
    }
}
