<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    
    public function index(Request $request)
    {
        $order=Order::search($request->all());
        return View('Admin.order.index',['order'=>$order,'search_data'=>$request->all()]);
    }
    public function view($id)
    {
        $order=Order::with(['get_order_row'])->where('id',$id)->firstOrFail();
        return View('Admin.order.view',['order'=>$order]);
    }
    public function set_status(Request $request)
    {
        if($request->ajax())
        {
            $order_id=$request->get('order_id');
            $status=$request->get('status');
            $order=Order::find($order_id);
            if($order)
            {
                $order->order_status=$status;
                if($order->update())
                {
                    return 'درخواست با موفقیت انجام شد';
                }
                else
                {
                    return 'خطا در اجرای درخواست';
                }
            }
            else
            {
                return 'خطا در اجرای درخواست';
            }
        }

    }
    public function destroy($id)
    {
        $order=Order::findOrFail($id);
        $order->delete();
        return redirect()->back();
    }

    
     
}
