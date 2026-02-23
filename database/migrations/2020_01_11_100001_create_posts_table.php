<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                
                $table->bigInteger('id')->autoIncrement()->unsigned();
                $table->string('post_id', 48)->unique();
                $table->string('post_title');
                $table->string('post_slug');
                $table->string('post_summary');
                $table->string('post_content');
                $table->string('post_featured_image');
                $table->string('post_author', 48)->index();
                $table->dateTime('post_date');
                $table->integer('post_status');
                $table->string('post_modified');
                $table->string('post_type_id', 48)->index();
                $table->string('parent_post_id', 48)->index();
                $table->string('location_id', 48)->index();
                $table->dateTime('created_at');
                $table->dateTime('updated_at');
                $table->dateTime('deleted_at')->nullable()->default(null);
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
        Schema::dropIfExists('posts');
    }
}
