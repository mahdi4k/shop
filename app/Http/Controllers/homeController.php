<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
 use Illuminate\Http\Request;

class homeController extends Controller
{
    public function __construct()
    {
        $cat=Category::where('parent_id',0)->get();
     }
public function index(){
     $product=Product::with('get_img')->where('product_status',1)->orderBy('id','DESC')->limit(8)->get();

    return view('index',compact('product'));
}
}
