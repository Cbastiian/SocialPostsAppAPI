<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('reason_id')->unsigned();
            $table->foreign('reason_id')
                ->references('id')
                ->on('report_reasons');

            $table->string('report_element_type');
            $table->bigInteger('report_element_id')->unsigned();

            $table->bigInteger('report_user_id')->unsigned();
            $table->foreign('report_user_id')
                ->references('id')
                ->on('users');

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
        Schema::dropIfExists('reports');
    }
}
