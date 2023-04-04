<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRailwaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('railways', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->integer('class');
            $table->integer('period');
            $table->string('from');
            $table->string('to')->default('Panvel');
            $table->date('date');
            $table->string('ticket_no')->nullable();
            $table->string('prev_certi_no')->nullable();
            $table->date('date_of_expiry')->nullable();
            $table->string('prev_from')->nullable();
            $table->string('prev_to')->nullable()->default('Panvel');
            $table->string('prev_class')->nullable();
            $table->string('prev_dated')->nullable();
            $table->integer('status')->default(0);
            $table->foreign('user_id')
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
        Schema::dropIfExists('railways');
    }
}
