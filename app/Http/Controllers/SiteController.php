<?php

namespace App\Http\Controllers;

use App\Amazing;
use App\Cart;
use App\Category;
use App\Color;
use App\Comment;
use App\Item;
use App\IndexSearch;
use App\Product;
use App\ProductScore;
use App\Question;
use App\ReView;
use App\Service;
use View;
use Validator;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Slider;
use App\lib\Mobile_Detect;
use App\Search;
use App\itemProduct;
use App\ContactUs;

class SiteController extends Controller
{
    protected  $view;
    public function __construct()
    {
        $detect = new Mobile_Detect();
        if($detect->isMobile() || $detect->isTablet())
        {
            $this->view='mobile.';
        }
        else
        {
            $this->view='';
        }

        $cat = Category::where('parent_id', 0)->get();


        View::share('category', $cat);
    }

    public function index()
    {
        
        $mobile_products=Search::get_mobile_category();
        $select_mobile_product=$mobile_products->pluck('id');
        $slider = Slider::orderBy('id', 'DESC')->limit(5)->get();
        $product = Product::with('get_img')->where('product_status', 1)->orderBy('id', 'DESC')->limit(8)->get();
        $old_amazing=Amazing::orderBy('timestamp','DESC')->first();
        $amazing = Amazing::with('get_img')->with('get_product')->orderBy('id', 'DESC')->get();
        $items = Item::get_mobile_items($select_mobile_product);
        $item_value=itemProduct::whereIn('product_id',[$select_mobile_product])->get();
         
        //$item_value = DB::table('item_product')->whereIn('product_id', ['17','19'])->pluck('value', 'item_id')->toArray();
        $view_name=$this->view.'site/index';
        return view($view_name, compact('product', 'amazing', 'slider','old_amazing','mobile_products','items','item_value'  ));
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
        $view_name=$this->view.'site/show';
        return view($view_name, compact('review', 'items', 'item_value', 'product', 'score_data'));
    }

    public function set_service(Request $request)
    {

        $service_id = $request->get('service_id');
        $product_id = $request->get('product_id');
        $items = Item::get_product_item($product_id);
        $color_id = $request->get('color_id');
        $product = Product::with('get_service_name')->find($product_id);
        $colors = $product->get_colors;
        $check = Service::where(['parent_id' => $service_id, 'product_id' => $product_id, 'color_id' => $color_id])->orderby('id', 'DESC')->first();
        $view_name=$this->view.'site.include.info_box';
        return View('site.include.info_box', ['colors' => $colors, 'items' => $items, 'service' => $check, 'color_id' => $color_id, 'product' => $product, 'service_id' => $service_id]);
    }

    public function get_tab_data(Request $request)
    {
        $tab_id = $request->get('tab_id');
        $product_id = $request->get('product_id');
        define('product_id', $product_id);
        if ($request->ajax()) {
            if ($tab_id == 'comment') {
                $score = ProductScore::with(['get_comment' => function ($query) {
                    $query->where(['product_id' => product_id, 'status' => 1]);
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
    public function add_question(Request $request)
    {
        $product_id = $request->get('product_id');
        $Validator = Validator::make(
            $request->all(),
            ['question' => 'required'],
            [],
            ['question' => 'متن پرسش']
        );
        if ($Validator->fails()) {
            return redirect()->back()->withErrors($Validator)->withInput();
        } else {
            $user_id = Auth::user()->id;
            Product::findOrFail($product_id);
            $Question = new Question($request->all());
            $Question->time = time();
            $Question->user_id = $user_id;
            $Question->status = 0;
            $Question->save();
            Session::put('status', 'پرسش شما با موفقیت ثبت شده و بعد از تایید مدیریت نمایش داده میشه');
            return redirect()->back();
        }
    }
    public function show_cart()
    {

        $view_name=$this->view.'site/cart';
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
            $view_name=$this->view.'site.include/ajax_cart';
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
            $view_name=$this->view.'site.include/ajax_cart';
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
    $e = explode('-', $product);
    if (sizeof($e) == 2) {
        if ($e[0] == 'DKP') {
            $user_id = Auth::user()->id;
            $product = Product::with('get_img')->findOrFail($e[1]);
            $score = ProductScore::with('get_user')->where(['user_id' => $user_id, 'product_id' => $product->id])->first();
            $comment = Comment::where(['user_id' => $user_id, 'product_id' => $product->id])->first();

            return View('site.comment_form', ['product' => $product, 'score' => $score, 'comment' => $comment]);
        } else {
            return view(404);
        }
    } else {
        return view(404);
    }
}

public function add_score(Request $request)
{
    $range = $request->get('range');
    $product_id = $request->get('product_id');
    if (is_array($range)) {
        $user_id = Auth::user()->id;
        $count = ProductScore::where(['user_id' => $user_id, 'product_id' => $product_id])->count();
        $time = time();
        if ($count == 0) {
            $score_value = '';
            foreach ($range as $key => $value) {
                settype($value, 'integer');
                $v = is_integer($value) ? $value : 0;
                $score_value .= $key . '_' . $value . '@#';
            }
            DB::table('product_score')->insert([
                'product_id' => $product_id,
                'value' => $score_value,
                'user_id' => $user_id,
                'time' => $time
            ]);
        }
    }
    return redirect()->back();
}
public function add_comment(Request $request)
{
    $Validator = Validator::make(
        $request->all(),
        ['subject' => 'required'],
        [],
        ['subject' => 'عنوان نقد و بررسی']
    );
    if ($Validator->fails()) {

        return redirect()->back()->withErrors($Validator)->withInput();
    } else {
        $product_id = $request->get('product_id');
        $product = Product::findOrFail($product_id);
        $user_id = Auth::user()->id;
        $count = ProductScore::where(['user_id' => $user_id, 'product_id' => $product_id])->count();
        if ($count > 0) {

            $advantages = $request->get('advantages');
            $disadvantages = $request->get('disadvantages');
            $a = '';
            $d = '';
            if (is_array($advantages)) {
                foreach ($advantages as $key => $value) {
                    $a .= $value . '@$E@';
                }
            }
            if (is_array($disadvantages)) {
                foreach ($disadvantages as $key => $value) {
                    $d .= $value . '@$E@';
                }
            }
            $Comment = new Comment();
            $Comment->subject = $request->get('subject');
            $Comment->product_id = $product_id;
            $Comment->comment_text = $request->get('comment_text');
            $Comment->advantages = $a;
            $Comment->disadvantages = $d;
            $Comment->user_id = $user_id;
            $Comment->status = 0;
            $Comment->save();
        }

        return redirect()->back();
    }

    
}

public function check_discount_code(Request $request)
    {
        $price=Session::get('price',0);
        $code=$request->get('discount_code');
        $discount=Discount::where(['code'=>$code])->get();
        if(sizeof($discount)>0)
        {
            $price=Session::get('price',0);
            $r=Discount::check_discount($discount,$price);
            if($r)
            {
                Session::put('discount',$r);

                $price2=Cart::getPrice();

                echo 'کد تخفیف وارد شده صحیح می باشد مبلغ نهایی برای پرداخت : '.$price2;
            }
            else
            {
                return 'error';
            }
        }
        else
        {
            return 'error';
        }


    }

    public function search(Request $request)
    {
        if($request->has('text'))
        {
            $text=$request->get('text');
            $Product=IndexSearch::get_product($text,$request->get('type',1),$request->get('product_status',0));
            if($request->ajax())
            {
                 return View('site.include.product_list2',['product'=>$Product,'cat_url'=>'','Search_text'=>$text]);
            }
            else
            {
                $view_name=$this->view.'site.search2';
                return View($view_name,['product'=>$Product,'Search_text'=>$text]);
            }
        }
        else
        {
            return redirect('');
        }

    }
    
    public function ajaxForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required',
        'text' => 'required',
    ]);




         $contact= new ContactUs();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->text = $request->text;


        $contact->save();

    }

}
