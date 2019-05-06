<?php

namespace App\Http\Controllers;

use App\Amazing;
use App\Category;
use App\Item;
use App\Product;
use App\ReView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function __construct()
    {
        $cat = Category::where('parent_id', 0)->get();
    }

    public function index()
    {
        $product = Product::with('get_img')->where('product_status', 1)->orderBy('id', 'DESC')->limit(8)->get();
        $amazing = Amazing::with('get_img')->with('get_product')->orderBy('id', 'DESC')->get();
        return view('site.index', compact('product', 'amazing'));
    }

    public function show($code, $title)
    {
        $product = Product::with('get_images')->with('get_colors')
            ->where(['code_url' => $code, 'title_url' => $title, 'show_product' => 1])->firstOrFail();
        $product->view = $product->view + 1;
        $product->update();
       $review = ReView::where(['product_id' => $product->id])->first();
       // $items = Item::get_product_item($product->id);
         $item_value = DB::table('item_product')->where('product_id', $product->id)->pluck('value', 'item_id')->toArray();
       // $score_data = ProductScore::get_score($product->id);

        return view('site/show', ['product' => $product ],['review'=>$review],['item_value'=>$item_value]);
    }
}
