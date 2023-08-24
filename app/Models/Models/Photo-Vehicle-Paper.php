<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhotoVehiclePaper extends Base
{
    protected $table = "photos_vehicle_papers";
    protected $fillable = [
        "id",
        "photo",
        "type"
    ];

    protected $hidden = [
        "vehicle_paper_id"
    ];

    public function vehiclePaper(): BelongsTo {
        return $this->belongsTo(VehiclePaper::class, "id", "vehicle_paper_id");
    }

}

enum PhotoVehiclePaperType: string {
    case PHOTOS = "PHOTOS";
    case OTHER = "OTHER";
    case RECORD = "RECORD";
    case REVIEWED = "REVIEWED";
    case POLICY = "POLICY";
    case WEIGHT_CARD = "WEIGHT_CARD";
    case DIMENSION_CARD = "DIMENSION_CARD";
    case PLATE_PAYMENT_RECEIPT = "PLATE_PAYMENT_RECEIPT";
    case SCANNED_STICKER = "SCANNED_STICKER";
}