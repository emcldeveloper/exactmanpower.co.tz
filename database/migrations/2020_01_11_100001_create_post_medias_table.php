<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('post_medias')) {
            Schema::create('post_medias', function (Blueprint $table) {
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                
                $table->bigInteger('id')->autoIncrement()->unsigned();
                $table->string('post_media_id', 48)->unique();
                $table->string('post_id', 48)->index();
                $table->string('name', 48);
                $table->string('original_name', 48);
                $table->tinyInteger('type')->length(1)->index();
                $table->float('size');
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
        Schema::dropIfExists('post_medias');
    }
}
