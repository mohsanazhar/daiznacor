<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Base
{
    protected $table = "districts";

    protected $fillable = [
        "id",
        "name",
        "province_id"
    ];

    protected $hidden = [
        "deleted_at",
        "created_at",
        "updated_at"
    ];

    public function companies(): HasMany {
        return $this->hasMany(Company::class, "id");
    }

}
