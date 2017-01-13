<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='blog_category';
    protected $primaryKey='cate_id';
    protected $guarded = [];
    public $timestamps=false;

}
