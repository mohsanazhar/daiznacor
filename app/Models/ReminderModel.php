<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReminderModel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'reminders';
    protected $primaryKey = 'id';
    protected $fillable= ['title','start','end','allDay','className','description','location','user_id'];
    function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
