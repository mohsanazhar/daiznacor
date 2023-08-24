<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaModel extends Model
{
    protected $table = 'media';
    protected $primaryKey = 'id';
    protected $fillable = ['media','post_by','user_id','name'];
}
