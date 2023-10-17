<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Corregimiento extends Base
{
    use SoftDeletes;
    protected $table = "corregimientos";

    protected $fillable = [
        "id",
        "name",
        "district_id"
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
