<?php

namespace App\Http\Controllers\Admin;

use App\lib\Jdf;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PanelCotroller extends Controller
{
    public function index()
    {
        $Jdf=new Jdf();
        $y=$Jdf->tr_num($Jdf->jdate('Y'));
        $m=$Jdf->tr_num($Jdf->jdate('n'));
        $t=$Jdf->tr_num($Jdf->jdate('t'));
        $date_list=array();
        $total_price=array();
        $order_count=array();
        for ($i=1;$i<=$t;$i++)
        {
            $date=$y.'-'.$m.'-'.$i;
            $date_list[$i]=$date;
            $total_price[$i]=Order::where(['date'=>$date,'pay_status'=>1])->sum('price');
            $order_count[$i]=Order::where(['date'=>$date,'pay_status'=>1])->count();
        }
        return View('Admin.panel',[
            'total_price'=>$total_price,
            'order_count'=>$order_count,
            'date_list'=>$date_list
        ]);
   }
}
