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
     $products=Product::with('get_img')->where('product_status',1)->orderBy('id','DESC')->limit(15)->get();

    return view('index',compact('products'));
}
}
