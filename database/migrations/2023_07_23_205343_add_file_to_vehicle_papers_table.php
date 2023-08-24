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
        Schema::table('vehicle_papers', function (Blueprint $table) {
            $table->text('record')->nullable();
            $table->text('reviewed')->nullable();
            $table->text('policy')->nullable();
            $table->text('weight-dimension')->nullable(true);
            $table->text('payment-receipt')->nullable();
            $table->text('scanned-sticker')->nullable(true);
            $table->text('photos-01')->nullable();
            $table->text('photos-02')->nullable();
            $table->text('photos-03')->nullable();
            $table->text('photos-04')->nullable();
            $table->text('others')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_papers', function (Blueprint $table) {
            $table->dropColumn('record');
            $table->dropColumn('reviewed');
            $table->dropColumn('policy');
            $table->dropColumn('weight-dimension');
            $table->dropColumn('payment-receipt');
            $table->dropColumn('scanned-sticker');
            $table->dropColumn('photos-01');
            $table->dropColumn('photos-02');
            $table->dropColumn('photos-03');
            $table->dropColumn('photos-04');
            $table->dropColumn('others');
        });
    }
};
