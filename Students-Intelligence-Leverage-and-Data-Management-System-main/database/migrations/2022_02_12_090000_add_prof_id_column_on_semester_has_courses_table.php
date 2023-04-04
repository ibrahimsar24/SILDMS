<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfIdColumnOnSemesterHasCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('semester_has_courses', function (Blueprint $table) {
            $table->bigInteger('prof_id')->unsigned()->index()->nullable();
            $table->foreign('prof_id')
                ->references('id')
                ->on('users')
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
        Schema::table('semester_has_courses', function (Blueprint $table) {
            $table->dropColumn('prof_id');
        });
    }
}
