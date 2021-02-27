<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteCascadeUserEventInScanUserCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scan_user_companies', function (Blueprint $table) {

            $table->dropForeign('scan_user_companies_scanusersource_foreign');
            $table->dropColumn('scanUserSource');

            $table->dropForeign('scan_user_companies_scancompanydestination_foreign');
            $table->dropColumn('scanCompanyDestination');


        });

        Schema::table('scan_user_companies', function (Blueprint $table) {

            $table->integer('scanUserSource')->unsigned();

            $table->foreign('scanUserSource')

                ->references('id')

                ->on('user_events')

                ->onDelete('cascade')

                ->onUpdate('cascade');

            $table->integer('scanCompanyDestination')->unsigned();

            $table->foreign('scanCompanyDestination')

                ->references('id')

                ->on('companies')

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

        Schema::table('scan_user_companies', function (Blueprint $table) {

            $table->dropForeign('scan_user_companies_scanusersource_foreign');
            $table->dropColumn('scanUserSource');

            $table->dropForeign('scan_user_companies_scancompanydestination_foreign');
            $table->dropColumn('scanCompanyDestination');

        });
    }
}
