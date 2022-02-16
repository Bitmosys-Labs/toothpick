<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdeDocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ide_doc', function (Blueprint $table) {
            $table->id();
            $table->integer('ide_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('doc_id')->nullable();
            $table->date('validity')->nullable();
            $table->text('feedback')->nullable();
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
        Schema::dropIfExists('ide_doc');
    }
}
