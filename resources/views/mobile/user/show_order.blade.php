@extends('mobile.layout')
@section('content')
    
<?php

$array=array();
$array[0]='در انتظار پرداخت';
$array[1]='در انتظار تایید مدیریت';
$array[2]='پردازش انبار';
$array[3]='آماده ارسال';
$array[4]='تحویل داده شده';
$array[5]='عدم دریافت محصول';
$array[-1]='عدم پرداخت'
 
?>
@php
function arabic_w2e($str)
                {
                    $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
                    $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
                    return str_replace($arabic_western, $arabic_eastern, $str);
                }
    
@endphp
<div class="row content_box text-right">

    <div style="width:95%;margin:30px auto">

        <div class="col-md-12">
            <p>از خرید شما سپاسگذاریم</p>
            @if($order->pay_status==1)

                <p style="color:red;padding-top:10px;text-align:justify">
                    خريد شما با موفقيت انجام شد و در حال آماده سازي براي ارسال مي باشد
                </p>

                <a style="color:blue;" href="{{ url('user/order/print').'/?id='.$order->id }}">دریافت فاکتور سفارش</a>
            @else

                @if($order->pay_type==6 or $order->pay_type==7)
                    <p style="color:red;padding-top:10px;text-align:justify">
                        با توجه به روش ارسال انتخاب شده براي اين سفارش، قبل از ارسال کالا مي‌توانيد پرداخت سفارش خود را تکميل نماييد. توجه کنيد که تا 48 ساعت سفارش شما منتظر پرداخت خواهد بود و پس از آن بطور خودکار از فرآيند خريد خارج مي‌گردد
                    </p>

                @elseif($order->pay_type==5)
                    <p style="color:red;padding-top:10px;text-align:justify">
                        خريد شما با موفقيت انجام شد و در حال آماده سازي براي ارسال مي باشد
                    </p>
                @else

                @endif

            @endif
        </div>

        <div class="col-md-12">
            <table class="table table-bordered order_table">
                <tr>
                    <td colspan="2">خلاصه وضعیت سفارش</td>
                </tr>
                <tr>
                    <td>شماره سفارش</td>
                    <?php
                     $code=$order->time;
                     $user_id=Auth::user()->id;
                    $order_code=substr($code,1,5).$user_id.substr($code,5,10);
                     ?>
                    <td>{{ $order_code }}</td>
                </tr>

                <tr>
                    <td>قیمت کل </td>
                    <td>{{ arabic_w2e( number_format($order->total_price)) }} تومان</td>
                </tr>

                <tr>
                    <td>مبلغ  قابل واریز</td>
                    <td>{{ arabic_w2e( number_format($order->price)) }} تومان</td>
                </tr>

                <tr>
                    <td>وضعیت پرداخت</td>
                    <td>
                        @if($order->pay_status==1)
                            <span style="color:red">پرداخت شده</span>
                        @else
                        در انتظار پرداخت
                        @endif
                    </td>
                </tr>

                <tr>
                    <td>وضعیت سفارش</td>
                    <td style="color:red">
                        {{ $array[$order->order_status] }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="col-md-12">
            <table class="table table-bordered order_table">

                <tr>
                    <td colspan="2">اطلاعات ارسال سفارش</td>
                </tr>

                <tr>
                    <td>نام و نام خانوادگی</td>
                    <td>
                        {{ $order->get_address_data->name }}
                    </td>
                </tr>

                <tr>
                    <td>استان - شهر</td>
                    <td>
                        {{ $order->get_address_data->get_ostan->ostan_name.' - '.$order->get_address_data->get_shahr->shahr_name }}
                    </td>
                </tr>

                <tr>
                    <td>شماره تماس</td>
                    <td>
                        <p>{{ $order->get_address_data->mobile }}</p>
                        <p>{{ $order->get_address_data->tell_code.'-'.$order->get_address_data->tell }}</p>
                    </td>
                </tr>
                <tr>
                    <td>شیوه ارسال محصول</td>
                    <td>
                        @if($order->order_type==1)
                            تحويل اکسپرس ديجي‌کالا
                        @else
                            باربري (پس کرايه | لوازم خانگي سنگين)
                        @endif
                    </td>
                </tr>
            </table>
        </div>


        <div style="width:100%;float:right">

              <h6 class="text-center">شرح محصول</h6>
                @foreach($order->get_order_row as $key=>$value)

                    <?php
                    $product=$value->get_product;
                    ?>
                     
                         
                            <div style="width:100%" class="cart_div">
                                 <div class="w-100 d-flex justify-content-center">
                                    <img width="100px" class="cart_img" src="{{ url('upload/'.$value->get_product_img->url) }}">
                                </div>
                                <div class="col-md-8">
                                    <p><a href="{{ url('product').'/'.$product->code_url.'/'.$product->title_url }}">{{ $product->title }}</a></p>
                                    <p><a href="{{ url('product').'/'.$product->code_url.'/'.$product->title_url }}">{{ $product->code }}</a></p>
                                    @if($value->get_color)
                                        <p style="color:#777">
                                            <span>رنگ : </span>
                                            <label style="background:#{{ $value->get_color->color_code }}" class="color_product"></label>
                                            <span>{{ $value->get_color->color_name }}</span>
                                        </p>
                                    @endif
                                    @if($value->get_service)
                                        <p style="color:#777"><span>گارانتی : </span> {{ $value->get_service->service_name }}</p>
                                    @endif
                                </div>
                            
                         
                        <div class="cart_number mr-5">
                           <p>تعداد : {{ $value->number }}</p>
                        </div>
                         
                        <div class="cart_price mr-2">
                            <p>
                                <?php
                                $price=$value->number*($product->price-$product->discounts);
                                ?>
                                <span style="color:green" class="p1">{{ arabic_w2e( number_format($price)) }}</span>
                                <span style="color:green" class="p2">تومان</span>
                            </p>
                        </div>
                    </div>
                @endforeach

            


             



        </div>

    </div>



</div>

@endsection