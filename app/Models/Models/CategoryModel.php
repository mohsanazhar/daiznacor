<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryModel extends Model
{
    use SoftDeletes;
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $fillable = ['name','type','parent','user_id'];

    function childs(){
        return $this->hasMany('App\Models\CategoryModel','parent','id');
    }
}
