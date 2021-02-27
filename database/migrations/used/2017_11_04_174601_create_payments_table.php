<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('user_id')->unsigned();

            $table->integer('event_id')->unsigned();

            $table->integer('payment_method_id')->unsigned();

            $table->decimal('paymentAmount',10,2)->default(0.0);

            $table->string('paymentVoucher')->default('noPaymentVoucherPicture.png');

            $table->string('paymentVoucherPath');

            $table->foreign('user_id')

                ->references('id')

                ->on('users')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->foreign('event_id')

                ->references('id')

                ->on('events')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->foreign('payment_method_id')

                ->references('id')

                ->on('payment_methods')

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

        Schema::dropIfExists('payments');

    }
}
