<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('career_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('resume', 255);
            $table->text('message');
            $table->string('status', 7);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('career_id')
                  ->references('id')
                  ->on('careers')
                  ->onDelete('cascade');
            $table->foreign('branch_id')
                  ->foreign('branch_id')
                  ->references('id')
                  ->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('applicants');
    }
}
