<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PasswordResetToken extends Base
{
    protected $table = "password-reset-tokens";

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
