<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Policy extends Base
{
    protected $table = "policies";

    protected $fillable = [
        "id",
        "number",
        "insured_name",
        "identification_card",
        "policy_issuance",
        "policy_expiration",
        "insurance_company_id"
    ];

    protected $hidden = [
        "insurance_company_id",
        "deleted_at"
    ];

    public function vehicles(): HasMany {
        return $this->hasMany(Vehicle::class, "id");
    }

    public function insuranceCompany(): BelongsTo {
        return $this->belongsTo(InsuranceCompany::class, "insurance_company_id");
    }
}
