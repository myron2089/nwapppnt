<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('event_resources', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->string('eventResourceName');

            $table->text('eventResourceDescription')->nullable();

            $table->string('eventResourcePicture')->defaault('noResourcePicture.png');

            $table->string('eventResourcePicturePath')->nullable();

            $table->decimal('eventResourceCost',10,2)->default(0.0);

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

        Schema::dropIfExists('event_resources');

    }
}
