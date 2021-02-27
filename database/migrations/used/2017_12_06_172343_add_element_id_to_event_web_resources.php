<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddElementIdToEventWebResources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_web_resources', function (Blueprint $table) {

            $table->string('eventWebResourcePath')->nullable();

            $table->integer('event_web_resource_element_id')->unsigned();

            $table->foreign('event_web_resource_element_id')

                ->references('id')

                ->on('event_web_resource_elements')

                ->onDelete('restrict')

                ->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_web_resources', function (Blueprint $table) {

            $table->dropColumn('event_web_resource_element_id');

        });
    }
}
