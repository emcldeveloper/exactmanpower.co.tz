<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_view_types', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement()->unsigned();
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->string('user_id', 48)->unique();
            $table->tinyInteger('status')->length(1)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_view_types');
    }
};
