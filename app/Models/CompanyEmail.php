<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyEmail extends Base
{
    protected $table = "company_emails";

    protected $fillable = [
        "id",
        "email",
        "company_id"
    ];

    protected $hidden = [
        "company_id",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function company(): BelongsTo {
        return $this->belongsTo(Company::class, "company_id", "id");
    }

}
