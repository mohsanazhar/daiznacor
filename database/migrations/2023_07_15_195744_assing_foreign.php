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
        Schema::table('policies', function (Blueprint $table) {
            $table->unsignedBigInteger('insurance_company_id')->nullable(false);
            $table->foreign('insurance_company_id')->references('id')->on('insurance_companies');
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->unsignedBigInteger('vehicle_type_id')->nullable();
            $table->unsignedBigInteger('municipality_id')->nullable(false);
            $table->unsignedBigInteger('owner_id')->nullable(false);
            $table->unsignedBigInteger('policy_id')->nullable();
            $table->unsignedBigInteger('fuel_type_id')->nullable();

            $table->foreign('vehicle_type_id')->references('id')->on('types_vehicles');
            $table->foreign('municipality_id')->references('id')->on('municipalities');
            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('policy_id')->references('id')->on('policies');
            $table->foreign('fuel_type_id')->references('id')->on('fuel_types');
        });

        Schema::table('vehicle_papers', function (Blueprint $table) {
            $table->unsignedBigInteger('vehicle_id')->nullable(false);
            $table->unsignedBigInteger('owner_id')->nullable(false);

            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->foreign('owner_id')->references('id')->on('users');
        });

        Schema::table('photos_vehicle_papers', function (Blueprint $table) {
            $table->unsignedBigInteger('vehicle_paper_id')->nullable(false);
            $table->foreign('vehicle_paper_id')->references('id')->on('vehicle_papers');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('corregimiento_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->unsignedBigInteger('created_by_user_id')->nullable(false);

            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('corregimiento_id')->references('id')->on('corregimientos');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('created_by_user_id')->references('id')->on('users');
        });

        Schema::table('company_emails', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable(false);
            $table->foreign('company_id')->references('id')->on('companies');
        });

        Schema::table('company_phone_numbers', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable(false);
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('policies', function (Blueprint $table) {
            $table->dropForeign(['insurance_company_id']);
            $table->dropColumn('insurance_company_id');
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign(['vehicle_type_id']);
            $table->dropColumn('vehicle_type_id');

            $table->dropForeign(['municipality_id']);
            $table->dropColumn('municipality_id');

            $table->dropForeign(['owner_id']);
            $table->dropColumn('owner_id');

            $table->dropForeign(['policy_id']);
            $table->dropColumn('policy_id');

            $table->dropForeign(['fuel_type_id']);
            $table->dropColumn('fuel_type_id');
        });

        Schema::table('vehicle_papers', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
            $table->dropColumn('vehicle_id');

            $table->dropForeign(['owner_id']);
            $table->dropColumn('owner_id');
        });

        Schema::table('photos_vehicle_papers', function (Blueprint $table) {
            $table->dropForeign(['vehicle_paper_id']);
            $table->dropColumn('vehicle_paper_id');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['province_id']);
            $table->dropColumn('province_id');

            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            $table->dropForeign(['created_by_user_id']);
            $table->dropColumn('created_by_user_id');
        });

        Schema::table('company_emails', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
        });

        Schema::table('company_phone_numbers', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
        });
    }
};
