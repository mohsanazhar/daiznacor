<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Base
{
    protected $table = "companies";

    protected $fillable = [
        "id",
        "name",
        'dv',
        "identification_card",
        "district",
        "corregimiento",
        "street",
        "user_id",
        "created_by_user_id",
        "province_id",
        "district_id",
        "corregimiento_id",
        "house_number",
        "avatar"
    ];

    protected $hidden = [
        "province_id",
        "district_id",
        "corregimiento_id",
        "user_id",
        "created_by_user_id",
        "updated_at",
        "deleted_at",
    ];

    public function vehicles(): HasMany {
        return $this->hasMany(Vehicle::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, "user_id");
    }

    public function createdByUserId(): BelongsTo {
        return $this->belongsTo(User::class, "created_by_user_id");
    }

    public function province(): BelongsTo {
        return $this->belongsTo(Province::class, "province_id", "id");
    }

    public function emails(): HasMany {
        return $this->hasMany(CompanyEmail::class);
    }

    public function phoneNumbers(): HasMany {
        return $this->hasMany(CompanyPhoneNumber::class);
    }

    public function distric(): BelongsTo {
        return $this->belongsTo(District::class, "district_id", "id");
    }

    public function corregimiento(): BelongsTo {
        return $this->belongsTo(Corregimiento::class, "corregimiento_id", "id");
    }
}
