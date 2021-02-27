<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetUserIdToNullOnEventSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_sessions', function (Blueprint $table) {

            $table->dropForeign('event_sessions_user_id_foreign');
            $table->dropColumn('user_id');

        });

        Schema::table('event_sessions', function (Blueprint $table) {

            $table->integer('user_id')->unsigned()->nullable();

            $table->foreign('user_id')

                ->references('id')

                ->on('users')

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
        Schema::table('event_sessions', function (Blueprint $table) {

            $table->dropForeign('event_sessions_user_id_foreign');
            $table->dropColumn('user_id');

        });
    }
}
