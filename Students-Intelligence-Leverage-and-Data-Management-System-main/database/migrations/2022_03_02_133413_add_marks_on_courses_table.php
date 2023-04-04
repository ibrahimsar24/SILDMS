<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMarksOnCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->bigInteger('ut1')->nullable();
            $table->bigInteger('ut2')->nullable();
            $table->bigInteger('ese')->nullable();
            $table->bigInteger('tw')->nullable();
            $table->bigInteger('oral')->nullable();
            $table->bigInteger('oral_practical')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('ut1');
            $table->dropColumn('ut2');
            $table->dropColumn('ese');
            $table->dropColumn('tw');
            $table->dropColumn('oral');
            $table->dropColumn('oral_practical');
        });
    }
}
