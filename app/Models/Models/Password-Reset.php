<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PasswordReset extends Base
{
    protected $table = "password-resets";

    protected $fillable = [
        "email",
        "token",
    ];

    protected $hidden = [
        "email",
        "token",
    ];

    public function users(): BelongsTo {
        return $this->belongsTo(User::class, "email", "email");
    }
}
