<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('fermata');
            $table->string('car_type');
            $table->string('driver');
            $table->string('morning1')->nullable();
            $table->string('morning2')->nullable();
            $table->string('morning3')->nullable();
            $table->string('morning4')->nullable();
            $table->string('day1')->nullable();
            $table->string('day2')->nullable();
            $table->string('night1')->nullable();
            $table->string('night2')->nullable();
            $table->string('night3')->nullable();
            $table->string('night4')->nullable();
            $table->string('night5')->nullable();
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('schedules');
    }
}
