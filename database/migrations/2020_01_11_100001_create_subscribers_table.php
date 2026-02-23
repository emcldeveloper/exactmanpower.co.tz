<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('subscribers')) {
            Schema::create('subscribers', function (Blueprint $table) {
                $table->charset = 'latin1';
                $table->collation = 'latin1_swedish_ci';
                
                $table->bigInteger('id')->autoIncrement()->unsigned();
                $table->string('subscriber_id', 48)->unique();
                $table->string('email');
                $table->string('query');
                $table->string('subscription_type_id', 48)->index();
                $table->boolean('is_valid')->default(false);
                $table->tinyInteger('status')->length(1)->index();
                $table->text('notes');
                $table->dateTime('timestamp');
                $table->string('deactivated_at');
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
        Schema::dropIfExists('subscribers');
    }
}
