<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForeignKeyPostTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_tags', function (Blueprint $table) {
            $table->foreign('post_id')->references('post_id')->on('posts');
            $table->foreign('tag_id')->references('tag_id')->on('tags');
            $table->foreign('tag_type_id')->references('tag_type_id')->on('tag_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_tags', function (Blueprint $table) {
            $table->dropForeign('post_tags_post_id_foreign');
            $table->dropForeign('post_tags_tag_id_foreign');
            $table->dropForeign('post_tags_tag_type_id_foreign');
        });
    }
}
