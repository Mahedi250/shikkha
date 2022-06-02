<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMonthlyFeeToSmStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sm_students', function (Blueprint $table) {
            $table->string('monthly_fee',10)->nullable()->default('0')->after('academic_id');
            $table->string('student_type',20)->nullable()->default('General')->after('student_photo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sm_students', function (Blueprint $table) {
            //
        });
    }
}
