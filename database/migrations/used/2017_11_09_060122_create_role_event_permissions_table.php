<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleEventPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_event_permissions', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('event_id')->unsigned();

            $table->integer('role_id')->unsigned();

            $table->integer('permission_id')->unsigned();

            $table->foreign('event_id')

                ->references('id')

                ->on('events')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->foreign('role_id')

                ->references('id')

                ->on('roles')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->foreign('permission_id')

                ->references('id')

                ->on('permissions')

                ->onDelete('restrict')

                ->onUpdate('cascade');

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

        Schema::dropIfExists('role_event_permissions');

    }
}
