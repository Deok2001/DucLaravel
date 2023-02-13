<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    public $timestamps =  false;
    protected $fileable= ['brand_name' , 'brand_desc', 'brand_status'];
    protected $primarykey = 'brand_id';
    protected $table = 'tbl_brand';
}
