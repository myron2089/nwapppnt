<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_settings', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('setting_id')->unsigned();

            $table->foreign('setting_id')

                ->references('id')

                ->on('settings')

                ->onDelete('cascade')

                ->onUpdate('cascade');

            $table->integer('event_id')->unsigned();

            $table->foreign('event_id')

                ->references('id')

                ->on('events')

                ->onDelete('cascade')

                ->onUpdate('cascade');

            $table->integer('settingStatus')->unsigned();

            $table->softDeletes();

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
        Schema::dropIfExists('event_settings');
    }
}
