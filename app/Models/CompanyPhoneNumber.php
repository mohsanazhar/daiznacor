<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyPhoneNumber extends Base
{
    protected $table = "company_phone_numbers";

    protected $fillable = [
        "id",
        "phone_number",
        "company_id"
    ];

    protected $hidden = [ 
        "company_id",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function company(): BelongsTo {
        return $this->belongsTo(Company::class, "company_id");
    }
}
