<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('plate_no');
            $table->string('car_type');
            $table->string('requester')->nullable();
            $table->text('causes')->nullable();
            $table->string('organization')->nullable();
            $table->string('status')->nullable();
            $table->string('remark')->nullable();
            $table->timestamp('date')->useCurent();
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
        Schema::dropIfExists('maintenances');
    }
}
