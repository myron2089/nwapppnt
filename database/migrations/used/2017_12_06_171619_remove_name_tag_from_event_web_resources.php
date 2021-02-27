<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveNameTagFromEventWebResources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_web_resources', function (Blueprint $table) {

            $table->dropColumn('eventWebResourceName');

            $table->dropColumn('eventWebResourceTag');

            $table->dropColumn('eventWebResourcePath');

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

            $table->string('eventWebResourceName');

            $table->string('eventWebResourceTag');

            $table->string('eventWebResourcePath');

        });
    }
}
