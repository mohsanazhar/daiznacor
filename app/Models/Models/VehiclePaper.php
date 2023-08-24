<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VehiclePaper extends Base
{
    protected $table = "vehicle_papers";

    protected $fillable = [
        "record",
        "reviewed",
        "policy",
        "weight-dimension",
        "payment-receipt",
        "scanned-sticker",
        "photos-01",
        "photos-02",
        "photos-03",
        "photos-04",
        "others",
        "vehicle_id",
        "owner_id",
    ];

    protected $hidden = [
        "vehicle_id",
    ];

    public function photoVehiclePapers(): HasMany {
        return $this->hasMany(PhotoVehiclePaper::class);
    }

    public function owner(){
        return $this->belongsTo(User::class,'id','id');
    }
}