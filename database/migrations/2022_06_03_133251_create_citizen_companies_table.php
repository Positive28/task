<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitizenCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizen_companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('citizen_id');
            $table->unsignedBigInteger('company_id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->foreign('citizen_id')->references('id')->on('citizens')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citizen_companies');
    }
}
