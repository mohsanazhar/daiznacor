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
        Schema::create('photos_vehicle_papers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('photo')->nullable(false);
            $table->enum('type', ['PHOTOS', 'OTHERS', 'RECORD', 'REVIEWED', 'POLICY', 'WEIGHT_CARD', 'DIMENSION_CARD', 'PLATE_PAYMENT_RECEIPT', 'SCANNED_STICKER'])->nullable(false);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos_vehicle_papers');
    }
};
