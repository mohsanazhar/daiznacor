<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Municipaly extends Base
{
    protected $table = "municipalities";
    
    protected $fillable = [
        "id",
        "name",
        "deleted_at",
        "created_at",
        "updated_at"
    ];

    public function vehicles(): HasMany {
        return $this->hasMany(Vehicle::class, "id");
    }
}
