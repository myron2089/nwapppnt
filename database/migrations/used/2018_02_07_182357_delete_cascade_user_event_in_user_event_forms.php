<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteCascadeUserEventInUserEventForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_event_forms', function (Blueprint $table) {

            $table->dropForeign('user_event_forms_user_event_id_foreign');
            $table->dropColumn('user_event_id');

            $table->dropForeign('user_event_forms_form_id_foreign');
            $table->dropColumn('form_id');


        });

        Schema::table('user_event_forms', function (Blueprint $table) {

            $table->integer('user_event_id')->unsigned();

            $table->foreign('user_event_id')

                ->references('id')

                ->on('user_events')

                ->onDelete('cascade')

                ->onUpdate('cascade');

            $table->integer('form_id')->unsigned();

            $table->foreign('form_id')

                ->references('id')

                ->on('forms')

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
        Schema::table('user_event_forms', function (Blueprint $table) {

            $table->dropForeign('user_event_forms_user_event_id_foreign');
            $table->dropColumn('user_event_id');

            $table->dropForeign('user_event_forms_form_id_foreign');
            $table->dropColumn('form_id');

        });
    }
}
