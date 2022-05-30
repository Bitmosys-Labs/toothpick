<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id')->nullable();
            $table->float('amount')->nullable();
            $table->string('purpose')->nullable();
            $table->string('receipt')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('additional');
    }
}
