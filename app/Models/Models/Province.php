<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Base
{
    protected $table = "provinces";

    protected $fillable = [
        "id",
        "name"
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
