<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmHeaderMenuManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_header_menu_managers', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('element_id')->nullable();
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->boolean('show')->default(0);
            $table->boolean('is_newtab')->default(0);
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
        Schema::dropIfExists('sm_header_menu_managers');
    }
}
