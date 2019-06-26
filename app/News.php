<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
     protected $table='news'; 

     protected $fillable = ['title','viewCount','description','images','created_at','updated_at'];


     public function path()
    {
        return "/news/$this->id";
    }
    protected $casts = [
        'images'=>'array'
      ];
    }
