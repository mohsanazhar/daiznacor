<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FuelType extends Base
{
    protected $table = "fuel_types";

    protected $fillable = [
        "id",
        "name"
    ];

    public function vehicles(): HasMany {
        return $this->hasMany(Vehicle::class, "id");
    }
}
