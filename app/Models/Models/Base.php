<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Base extends Model
{
    use HasFactory, SoftDeletes;
    
    public $incrementing = true;
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $timestamps = true;
}
