<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table='blog_links';
    protected $primaryKey='link_id';
    public $timestamps=false;
    public $guarded=[];
}
