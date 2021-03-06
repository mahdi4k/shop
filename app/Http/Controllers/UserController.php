<?php

namespace App\Http\Controllers;

use App\Category;
use App\GiftCart;
use App\lib\Barcode;
use App\lib\Jdf;
use App\Order;
use Illuminate\Http\Request;
use Auth;
use View;
use Response;
use DB;
use App\lib\Mobile_Detect;
use App\Ostan;
use App\Address;

class UserController extends Controller
{
    protected  $view;
    public function __construct()
    {
        $detect = new Mobile_Detect() ;
        if($detect->isMobile() || $detect->isTablet())
        {
            $this->view='mobile.';
        }
        else
        {
            $this->view='';
        }
        $this->middleware('auth')->except('create_barcode');
        $cat = Category::where('parent_id', 0)->get();
        View::share('category', $cat);
    }
    public function index()
    {
        $this->report_data();
        $view_name=$this->view.'user.index';
        return View($view_name);
    }
    public function orders()
    {
        $this->report_data();
        $user_id = Auth::user()->id;
        $orders = Order::where(['user_id' => $user_id])->orderBy('id', 'DESC')->paginate(10);
        $view_name=$this->view.'user.orders';
        return View($view_name, ['orders' => $orders]);
    }
    public function show_order(Request $request)
    {
        $order_id = $request->get('id');
        $user_id = Auth::user()->id;
        $order = Order::with('get_address_data')->with('get_order_row')->where(['id' => $order_id, 'user_id' => $user_id])->firstOrFail();
        $view_name=$this->view.'user.show_order';
        return View($view_name, ['order' => $order]);
    }
    public function print_order(Request $request)
    {
        $user = Auth::user();
        $id = $request->get('id');
        $order = Order::with('get_address_data')->with('get_order_row')->where(['id' => $id, 'user_id' => $user->id, 'pay_status' => 1])->firstOrFail();
        return view('user.print', ['order' => $order]);
    }
    public function create_barcode(Request $request)
    {
        $code = $request->get('order_code') . '1';
        $fontSize = 10;
        $marge    = 10;
        $x        = 100;
        $y        = 40;
        $height   = 50;
        $width    = 2;
        $angle    = 0;

        $type     = 'ean13';


        $im     = imagecreatetruecolor(200, 80);
        $black  = ImageColorAllocate($im, 0x00, 0x00, 0x00);
        $white  = ImageColorAllocate($im, 247, 249, 250);

        imagefilledrectangle($im, 0, 0, 200, 80, $white);

        $data = Barcode::gd($im, $black, $x, $y, $angle, $type, array('code' => $code), $width, $height);

        // header('Content-type: image/png');
        imagepng($im);
        return Response::make('', 200)->header('Content-type', 'image/png');
        // imagedestroy($im);
    }
    private function report_data()
    {
        $user_id = Auth::user()->id;
        $total_user_orders = Order::where(['user_id' => $user_id])->count();
        View::share('total_user_orders', $total_user_orders);
    }
    public function editAdress(){
        
            $ostan=Ostan::get();
            $this->report_data();
            $user_id=Auth::user()->id;
            $address=Address::with('get_shahr')->with('get_ostan')->where('user_id',$user_id)->orderBy('id','DESC')->paginate(20);
            $view_name=$this->view.'user.editAddress';
        
        return view($view_name , compact('ostan','user_id','address','orders'));
    }
    
}
