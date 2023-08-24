<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Media extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('media',200)->nullable();
            $table->string('name',200)->nullable();
            $table->string('post_by')->nullable();
            $table->integer('user_id')->default(0);
            $table->integer('folder')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
}
