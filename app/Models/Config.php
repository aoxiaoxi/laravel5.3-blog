<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table='blog_config';
    protected $primaryKey='conf_id';
    public $timestamps=false;
    protected $guarded=[];
}
