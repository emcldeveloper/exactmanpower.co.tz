<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForeignKeyPostCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_comments', function (Blueprint $table) {
            $table->foreign('post_id')->references('post_id')->on('posts');
            $table->foreign('parent_post_comment_id')->references('post_comment_id')->on('post_comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_comments', function (Blueprint $table) {
            $table->dropForeign('post_comments_post_id_foreign');
            $table->dropForeign('post_comments_parent_post_comment_id_foreign');
        });
    }
}
