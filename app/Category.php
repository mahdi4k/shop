<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['cat_name', 'cat_ename', 'parent_id', 'img'];
    public $timestamps = false;

    public function getChild()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public static function get_cat_list()
    {
        $cat_list = array();
        $cat_list[0] = 'انتخاب سر دسته';
        $cat = Category::where('parent_id', 0)->get();
        foreach ($cat as $key => $value) {
            $cat_list[$value->id] = $value->cat_name;
            foreach ($value->getChild as $key2 => $value2) {
                $cat_list[$value2->id] = ' - ' . $value2->cat_name;
                foreach ($value2->getChild as $key3 => $value3) {
                    $cat_list[$value3->id] = ' - - ' . $value3->cat_name;
                }
            }
        }
        return $cat_list;
    }
    public function getParent()
    {
        return $this->hasOne(Category::class,'id','parent_id')->withDefault(['cat_name'=>'-']);
    }
    public static function search($data)
    {
        $Category=Category::orderBy('id','DESc');
        $string='';
        if(sizeof($data)>0)
        {
            if(array_key_exists('cat_name',$data) && array_key_exists('cat_ename',$data))
            {
                $Category=$Category->where('cat_name','like','%'.$data['cat_name'].'%')
                    ->where('cat_ename','like','%'.$data['cat_ename'].'%');
                $string='?cat_name='.$data['cat_name'].'&cat_ename='.$data['cat_ename'];
            }
        }
        $Category=$Category->paginate(10);
        $Category->withPath($string);
        return $Category;
    }
}

