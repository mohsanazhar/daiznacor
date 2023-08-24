<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeVehicle extends Base
{
    protected $table = "type_vehicles";

    protected $fillable = [
        "id",
        "name"
    ];

    public function vehicles(): HasMany {
        return $this->hasMany(Vehicle::class, "id");
    }
}
