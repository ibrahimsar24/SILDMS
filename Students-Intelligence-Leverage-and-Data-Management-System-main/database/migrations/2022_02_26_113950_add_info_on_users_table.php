<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email2')->nullable();
            $table->integer('gender')->nullable();
            $table->bigInteger('year_of_study')->nullable();
            $table->bigInteger('batch_year')->nullable();
            $table->date('dob')->nullable();
            $table->bigInteger('current_semester')->nullable();
            $table->bigInteger('branch_id')->unsigned()->index()->nullable();
            $table->foreign('branch_id')
                ->references('id')
                ->on('branches')
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email2');
            $table->dropColumn('gender');
            $table->dropColumn('year_of_study');
            $table->dropColumn('batch_year');
            $table->dropColumn('dob');
            $table->dropColumn('current_semester');
            $table->dropColumn('branch_id');
        });
    }
}
