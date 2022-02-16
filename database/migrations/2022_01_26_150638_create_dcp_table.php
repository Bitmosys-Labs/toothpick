<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDcpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dcp', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('staff_id')->nullable();
            $table->string('gdc_no')->nullable();
            $table->string('postcode')->nullable();
            $table->string('address', 255)->nullable();
            $table->string('latitude', 255)->nullable();
            $table->string('longitude', 255)->nullable();
            $table->string('country')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('relation_to_emergency_contact')->nullable();
            $table->integer('travel')->nullable();
            $table->float('hourly_rate')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('employment_history')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('dcp');
    }
}
