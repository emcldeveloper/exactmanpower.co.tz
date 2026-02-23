<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForeignKeyPostMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_metas', function (Blueprint $table) {
            $table->foreign('post_id')->references('post_id')->on('posts');
            $table->foreign('meta_id')->references('meta_id')->on('metas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_metas', function (Blueprint $table) {
            $table->dropForeign('post_metas_post_id_foreign');
            $table->dropForeign('post_metas_meta_id_foreign');
        });
    }
}
