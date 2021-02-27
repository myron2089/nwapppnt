<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::table('payments', function (Blueprint $table) {


            $table->integer('payment_status_id')->unsigned();

            $table->foreign('payment_status_id')

                ->references('id')

                ->on('payment_statuses')

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
        Schema::table('payments', function (Blueprint $table) {

            $table->dropColumn('payment_status_id');


        });
    }
}
