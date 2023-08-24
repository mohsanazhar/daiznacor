<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200)->nullable(false);
            $table->string('identification_card', 120)->nullable(false);
            $table->string('car_plate', 100)->nullable(false);
            $table->string('month_renewal', 2)->nullable(false);
            $table->string('brand', 192)->nullable(false); 
            $table->string('model', 192)->nullable(false);
            $table->string('year', 4)->nullable();
            $table->string('engine')->nullable(false);
            $table->string('chassis')->nullable(false);
            $table->string('color', 100)->nullable();
            $table->text('mortgagee')->nullable(false);
            $table->text('revised_no')->nullable();
            $table->string('weights', 100)->nullable();
            $table->string('dimensions', 100)->nullable();
            $table->timestamp('due_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
