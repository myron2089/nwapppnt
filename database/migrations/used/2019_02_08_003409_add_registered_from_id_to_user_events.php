<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegisteredFromIdToUserEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('user_events', function (Blueprint $table) {


            $table->integer('registered_from_id')->unsigned()->nullable();

            $table->foreign('registered_from_id')

                ->references('id')

                ->on('registered_from')

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
        //
        $table->dropColumn('registered_from_id');
    }
}
