<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('EmploymentsTable');
        Schema::create('EmploymentsTable',function(Blueprint $tables)
        {
            $tables->increments('employment_id');
            $tables->string('company_name');
            $tables->string('job_title');
            $tables->date('start_date');
            $tables->date('end_date');
            $tables->integer('user_id');
            $tables->foreign('user_id')->references('user_id')->on('User')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('EmploymentsTable');
    }
}

