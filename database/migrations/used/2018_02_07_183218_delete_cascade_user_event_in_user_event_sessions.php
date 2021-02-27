<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteCascadeUserEventInUserEventSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_event_session_favorites', function (Blueprint $table) {

            $table->dropForeign('user_event_session_favorites_user_event_id_foreign');
            $table->dropColumn('user_event_id');

            $table->dropForeign('user_event_session_favorites_event_session_id_foreign');
            $table->dropColumn('event_session_id');


        });

        Schema::table('user_event_session_favorites', function (Blueprint $table) {

            $table->integer('user_event_id')->unsigned();

            $table->foreign('user_event_id')

                ->references('id')

                ->on('user_events')

                ->onDelete('cascade')

                ->onUpdate('cascade');

            $table->integer('event_session_id')->unsigned();

            $table->foreign('event_session_id')

                ->references('id')

                ->on('event_sessions')

                ->onDelete('cascade')

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
        Schema::table('user_event_session_favorites', function (Blueprint $table) {

            $table->dropForeign('user_event_session_favorites_user_event_id_foreign');
            $table->dropColumn('user_event_id');

            $table->dropForeign('user_event_session_favorites_event_session_id_foreign');
            $table->dropColumn('event_session_id');

        });
    }
}
