<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InsuranceCompany extends Base
{
    protected $table = "insurance_companies";
    protected $fillable = [
        "id",
        "name"
    ];

    protected $hidden = [
        "deleted_at",
        "updated_at",
        "created_at",
    ];

    public function policies(): HasMany{
        return $this->hasMany(Policy::class, "id");
    }
}
