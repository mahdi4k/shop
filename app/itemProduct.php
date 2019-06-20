<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemProduct extends Model
{
    protected $table='item_product';
    protected $fillable=['id','item_id','value','product_id'];
    public $timestamps=false;
}
