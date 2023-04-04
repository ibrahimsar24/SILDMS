<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemesterHasCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semester_has_courses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('semester_id')->unsigned()->index();
            $table->bigInteger('course_id')->unsigned()->index();
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
        Schema::dropIfExists('semester_has_courses');
    }
}
