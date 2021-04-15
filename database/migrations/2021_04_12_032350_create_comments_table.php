<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->longText('content');

            $table->bigInteger('post_id')->unsigned();
            $table->foreign('post_id')
                ->references('id')
                ->on('post');

            $table->bigInteger('comentator_user_id')->unsigned();
            $table->foreign('comentator_user_id')
                ->references('id')
                ->on('users');

            $table->string('active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
