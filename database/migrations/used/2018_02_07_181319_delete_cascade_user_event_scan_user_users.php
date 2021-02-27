<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteCascadeUserEventScanUserUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scan_user_users', function (Blueprint $table) {

            $table->dropForeign('scan_user_users_scanusersource_foreign');
            $table->dropColumn('scanUserSource');

            $table->dropForeign('scan_user_users_scanuserdestination_foreign');
            $table->dropColumn('scanUserDestination');


        });

        Schema::table('scan_user_users', function (Blueprint $table) {

            $table->integer('scanUserSource')->unsigned();

            $table->foreign('scanUserSource')

                ->references('id')

                ->on('user_events')

                ->onDelete('cascade')

                ->onUpdate('cascade');

            $table->integer('scanUserDestination')->unsigned();

            $table->foreign('scanUserDestination')

                ->references('id')

                ->on('user_events')

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
        Schema::table('scan_user_users', function (Blueprint $table) {

            $table->dropForeign('scan_user_users_scanusersource_foreign');
            $table->dropColumn('scanUserSource');

            $table->dropForeign('scan_user_users_scanuserdestination_foreign');
            $table->dropColumn('scanUserDestination');

        });
    }
}
