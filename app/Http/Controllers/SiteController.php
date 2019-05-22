<?php

namespace App\Http\Controllers;

use App\Amazing;
use App\Cart;
use App\Category;
use App\Color;
use App\Comment;
use App\Item;
use App\Product;
use App\ProductScore;
use App\ReView;
use App\Service;
use View;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function __construct()
    {


        $cat = Category::where('parent_id', 0)->get();


        View::share('category', $cat);
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
        $items = Item::get_product_item($product->id);
        $item_value = DB::table('item_product')->where('product_id', $product->id)->pluck('value', 'item_id')->toArray();
        $score_data = ProductScore::get_score($product->id);
        return view('site/show', compact('review', 'items', 'item_value', 'product', 'score_data'));
    }

    public function set_service(Request $request)
    {
        $service_id = $request->get('service_id');
        $product_id = $request->get('product_id');
        $color_id = $request->get('color_id');
        $product = Product::with('get_service_name')->find($product_id);
        $colors = $product->get_colors;
        $check = Service::where(['parent_id' => $service_id, 'product_id' => $product_id, 'color_id' => $color_id])->orderby('id', 'DESC')->first();
        //$view_name=$this->view.'include/info_box';
        return View('site.include.info_box', ['colors' => $colors, 'service' => $check, 'color_id' => $color_id, 'product' => $product, 'service_id' => $service_id]);
    }

    public function get_tab_data(Request $request)
    {
        $tab_id = $request->get('tab_id');
        $product_id = $request->get('product_id');
        define('product_id', $product_id);
        if ($request->ajax()) {
            if ($tab_id == 'comment') {
                $score = ProductScore::with(['get_comment' => function ($query) {
                    $query->where(['product_id' => product_id, 'status' => 0]);
                }])->where(['product_id' => $product_id])->orderBy('id', 'DESC')->paginate(10);
                 return View('site.include.show_comment', ['score' => $score, 'product_id' => $product_id]);
            } elseif ($tab_id == 'question') {
                $question = Question::with('get_parent')->where(['product_id' => $product_id, 'status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->paginate(10);
                return View('site.include.add_question', ['product_id' => $product_id, 'question' => $question]);
            } else {
                return 'error';
            }
        }
    }

    public function show_cart()
    {
        $view_name = 'site/cart';
        return View($view_name);
    }

    public function cart(Request $request)
    {
        $product_id = $request->get('product_id', 0);
        $color_id = $request->get('color_id', 0);
        $service_id = $request->get('service_id', 0);
        $product = Product::findOrFail($product_id);
        $service = Service::where(['product_id' => $product_id, 'color_id' => $color_id, 'parent_id' => $service_id])->first();
        if ($service) {
            Cart::add_cart($product_id, $color_id, $service_id);
        } else {
            if ($color_id == 0 && $service_id != 0) {
                $service = Service::findOrFail($service_id);
                Cart::add_cart($product_id, $color_id, $service_id);
            } elseif ($color_id != 0 && $service_id == 0) {
                Color::where(['id' => $color_id, 'product_id' => $product_id])->firstOrFail();
                Cart::add_cart($product_id, $color_id, $service_id);
            } elseif ($color_id == 0 && $service_id == 0) {
                Cart::add_cart($product_id, $color_id, $service_id);
            }
        }
        return redirect('Cart');
    }

    public function del_cart(Request $request)
    {
        if ($request->ajax()) {
            $product_id = $request->get('product_id', 0);
            $color_id = $request->get('color_id', 0);
            $service_id = $request->get('service_id', 0);
            Cart::remove($product_id, $service_id, $color_id);
            $view_name = 'site/include/ajax_cart';
            return View($view_name);
        }
    }

    public function change_cart(Request $request)
    {
        if ($request->ajax()) {
            $product_id = $request->get('product_id', 0);
            $color_id = $request->get('color_id', 0);
            $service_id = $request->get('service_id', 0);
            $number = $request->get('number', 0);
            Cart::change($product_id, $service_id, $color_id, $number);
            $view_name = 'site.include/ajax_cart';
            return View($view_name);
        }
    }

    public function check_login(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::check()) {
                ?>
                <?php

            } else {
                ?>
                <script>
                    $("#myModal").modal('show');
                </script>
                <?php
            }
        }
    }

    public function comment_form($product)
    {
        $e=explode('-',$product);
        if(sizeof($e)==2)
        {
            if($e[0]=='DKP')
            {
                $user_id=Auth::user()->id;
                $product=Product::with('get_img')->findOrFail($e[1]);
                $score=ProductScore::with('get_user')->where(['user_id'=>$user_id,'product_id'=>$product->id])->first();
                $comment=Comment::where(['user_id'=>$user_id,'product_id'=>$product->id])->first();

                return View('site.comment_form',['product'=>$product,'score'=>$score,'comment'=>$comment]);
            }
            else
            {
                return view(404);
            }
        }
        else
        {
            return view(404);
        }
    }

    public function add_score(Request $request)
    {
        $range=$request->get('range');
        $product_id=$request->get('product_id');
        if(is_array($range))
        {
            $user_id=Auth::user()->id;
            $count=ProductScore::where(['user_id'=>$user_id,'product_id'=>$product_id])->count();
            $time=time();
            if($count==0)
            {
                $score_value='';
                foreach ($range as $key=>$value)
                {
                    settype($value,'integer');
                    $v=is_integer($value) ? $value : 0;
                    $score_value.=$key.'_'.$value.'@#';
                }
                DB::table('product_score')->insert([
                    'product_id'=>$product_id,
                    'value'=>$score_value,
                    'user_id'=>$user_id,
                    'time'=>$time
                ]);
            }

        }
        return redirect()->back();
    }
    public function add_comment(Request $request)
    {
        $Validator=Validator::make($request->all(),
            ['subject'=>'required'],[],['subject'=>'عنوان نقد و بررسی']);
        if($Validator->fails())
        {

            return redirect()->back()->withErrors($Validator)->withInput();
        }
        else
        {
            $product_id=$request->get('product_id');
            $product=Product::findOrFail($product_id);
            $user_id=Auth::user()->id;
            $count=ProductScore::where(['user_id'=>$user_id,'product_id'=>$product_id])->count();
            if($count>0)
            {

                $advantages=$request->get('advantages');
                $disadvantages=$request->get('disadvantages');
                $a='';
                $d='';
                if(is_array($advantages))
                {
                    foreach ($advantages as $key=>$value)
                    {
                        $a.=$value.'@$E@';
                    }
                }
                if(is_array($disadvantages))
                {
                    foreach ($disadvantages as $key=>$value)
                    {
                        $d.=$value.'@$E@';
                    }
                }
                $Comment=new Comment();
                $Comment->subject=$request->get('subject');
                $Comment->product_id=$product_id;
                $Comment->comment_text=$request->get('comment_text');
                $Comment->advantages=$a;
                $Comment->disadvantages=$d;
                $Comment->user_id=$user_id;
                $Comment->status=0;
                $Comment->save();

            }

            return redirect()->back();
        }

    }
}
