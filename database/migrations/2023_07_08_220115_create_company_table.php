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
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200)->nullable(false);
            $table->string('identification_card', 120)->nullable(false);
            $table->string('district', 191)->nullable();
            $table->string('corregimiento', 191)->nullable();
            $table->string('street', 191)->nullable();
            $table->string('house_number')->nullable();
            $table->text('avatar')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
