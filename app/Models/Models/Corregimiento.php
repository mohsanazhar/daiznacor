<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Corregimiento extends Base
{
    protected $table = "corregimientos";

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
