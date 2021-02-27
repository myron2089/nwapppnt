<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanyNullInCompanyForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_forms', function (Blueprint $table) {

            $table->dropForeign('company_forms_company_id_foreign');
            $table->dropColumn('company_id');

        });

        Schema::table('company_forms', function (Blueprint $table) {

            $table->integer('company_id')->unsigned()->nullable();

            $table->foreign('company_id')

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

        Schema::table('company_forms', function (Blueprint $table) {

            $table->dropForeign('company_forms_company_id_foreign');
            $table->dropColumn('company_id');

        });

    }
}
