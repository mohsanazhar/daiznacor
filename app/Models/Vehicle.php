<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Base
{
    protected $table = "vehicles";

    protected $fillable = [
        "id",
        "name",
        "identification_card",
        "car_plate",
        "month_renewal",
        "brand",
        "model",
        "year",
        "engine",
        "chassis",
        "color",
        "mortgagee",
        "revised_no",
        "weights",
        "dimensions",
        "created_by_user_id",
        "owner_id",
        "due_date",
        "vehicle_type_id",
        "owner_id",
        "policy_id",
        "company_id",
        "fuel_type_id",
        "municipality_id"
    ]; 

    protected $hidden = [
        "vehicle_type_id",
        "owner_id",
        "company_id",
        "policy_id",
        "fuel_type_id",
        "municipality_id",
        "created_by_user_id"
    ];

    public function owner(): BelongsTo {
        return $this->belongsTo(User::class, "owner_id");
    }

    public function createdByUser(): BelongsTo {
        return $this->belongsTo(User::class, "created_by_user_id");
    }

    public function company(): BelongsTo {
        return $this->belongsTo(Company::class, "company_id");
    }

    public function type(): BelongsTo {
        return $this->belongsTo(TypeVehicle::class, "vehicle_type_id");
    }

    public function municipaly(): BelongsTo {
        return $this->belongsTo(Municipaly::class, "municipality_id");
    }

    public function policy(): BelongsTo {
        return $this->belongsTo(Policy::class, "policy_id");
    }

    public function fuelType(): BelongsTo {
        return $this->belongsTo(FuelType::class, "fuel_type_id");
    }
}