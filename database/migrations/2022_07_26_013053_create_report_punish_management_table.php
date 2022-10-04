<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportPunishManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_punish_management', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('report_id')->unsigned();
            $table->foreign('report_id')
                ->references('id')
                ->on('reports');


            $table->string('message');
            $table->boolean('is_punished');
            $table->boolean('is_auto_punished');

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
        Schema::dropIfExists('report_punish_management');
    }
}
