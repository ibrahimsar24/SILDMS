<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->bigInteger('semester_id')->unsigned()->index()->nullable();
            $table->bigInteger('course_id')->unsigned()->index()->nullable();
            $table->bigInteger('ut1')->nullable();
            $table->bigInteger('ut2')->nullable();
            $table->bigInteger('tw')->nullable();
            $table->bigInteger('ese')->nullable();
            $table->bigInteger('oral')->nullable();
            $table->bigInteger('oral_practical')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('semester_id')
                ->references('id')
                ->on('semesters')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
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
        Schema::dropIfExists('results');
    }
}
