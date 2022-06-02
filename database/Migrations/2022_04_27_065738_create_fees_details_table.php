<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees_details', function (Blueprint $table) {
            $table->id();
            $table->integer('fees_payment_id');
            $table->integer('student_id')->nullable()->unsigned();
            $table->string('fees_type',50)->nullable();
            $table->string('fees_type_amount',10, 2)->nullable();
            $table->integer('fees_month')->nullable();
            $table->integer('fees_year')->nullable();
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('sm_students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fees_details');
    }
}
