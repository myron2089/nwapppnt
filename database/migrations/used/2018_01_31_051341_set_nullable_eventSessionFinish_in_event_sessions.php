<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNullableEventSessionFinishInEventSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_sessions', function (Blueprint $table) {

            $table->dropColumn('eventSessionFinish');


        });

        Schema::table('event_sessions', function (Blueprint $table) {

            $table->dateTime('eventSessionFinish')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_sessions', function (Blueprint $table) {

            $table->dropColumn('eventSessionFinish');


        });
    }
}
