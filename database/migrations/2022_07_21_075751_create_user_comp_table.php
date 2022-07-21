<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCompTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_comp', function (Blueprint $table) {
            $table->id();
            $table->integer('comp_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('picture')->nullable();
            $table->boolean('status')->nullable();
            $table->date('validity')->nullable();
            $table->longText('feedback')->nullable();
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
        Schema::dropIfExists('user_comp');
    }
}
