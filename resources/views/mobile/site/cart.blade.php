@extends('mobile.layout')
@section('content')

<div class="loading_div">
    <div class="loading2"></div>

</div>

<div style="width:100%;padding-bottom:50px;" id="product_cart">



    <div style="padding-top: 10px;">
        <?php

     $cart_date=\App\Cart::get();

     function arabic_w2e($str)
                {
                    $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
                    $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
                    return str_replace($arabic_western, $arabic_eastern, $str);
                }
                ?>

        @if(sizeof($cart_date)==0)

        <p style="color:red;text-align:center;padding-top:30px;padding-bottom: 20px;">سبد خرید شما خالی می باشد</p>

        @else

        <?php
         $total_price=0;
         $price=0;
         ?>

        @foreach($cart_date as $key=>$value)

        <?php

             $product_data=array_key_exists('product_data',$value) ? $value['product_data'] : array();
             $j=1;
             ?>

        @foreach($product_data as $key2=>$value2)
        <?php
                 $s_c=explode('_',$key2);
                 $service_id=$s_c[0];
                 $color_id=$s_c[1];
                 $data=\App\Cart::get_date($key,$service_id,$color_id);
                 ?>
        @if($data)

        <div class="cart_box">

            <div class="col-xs-5">
                <img class="cart_img" src="{{ $data['img'] }}">
            </div>
            <div class="col-xs-7">
                <p onclick="del_product('{{ $key }}','{{ $s_c[0] }}','{{ $s_c[1] }}')"><span class="fa fa-trash"></span>
                </p>
                <p><a href="{{ url('product').'/'.$data['code_url'].'/'.$data['title_url'] }}">{{ $data['code'] }}</a>
                </p>
                <p><a style="color: #818181;"
                        href="{{ url('product').'/'.$data['code_url'].'/'.$data['title_url'] }}">{{ $data['title'] }}</a>
                </p>
                @if(!empty($data['service_name']))
                <p style="color:#777"><span>گارانتی : </span> {{ $data['service_name'] }}</p>
                @endif
                @if(!empty($data['color_name']))
                <p style="color:#777">
                    <span>رنگ : </span>
                    <label style="background:#{{ $data['color_code'] }}" class="color_product"></label>
                    <span>{{ $data['color_name'] }}</span>
                </p>
                @endif


                <p>
                    <span style="padding-top:5px;">تعداد : </span>
                    <label class="number_cart_product">
                        <span
                            onclick="change_number_cart_product('{{ $value2+1 }}','{{ $key }}','{{ $color_id }}','{{ $service_id }}')">+</span>
                        <span style="background:white">{{ $value2 }}</span>
                        <span
                            onclick="change_number_cart_product('{{ $value2-1 }}','{{ $key }}','{{ $color_id }}','{{ $service_id }}')">-</span>
                    </label>
                </p>
            </div>


            <?php $j++; ?>

            <table class="table table-bordered text-center">
                <tr>
                    <td>قیمت واحد</td>
                    <td>{{ arabic_w2e(number_format($data['price2'])) }} تومان</td>
                </tr>
                <tr style="color:#4CAF50">
                    <td>قیمت کل</td>
                    <td>{{ arabic_w2e(number_format($data['price2']*$value2))}} تومان </td>
                </tr>
            </table>

            <div style="clear:both"></div>
        </div>

        <?php
                     $total_price+=$data['price1']*$value2;
                     $price+=$data['price2']*$value2;
                     ?>
        @endif

        @endforeach

        @endforeach


        <div class="w-100 pr-2 pl-2">
            <div class="cart_price2">
                <div>
                    <?php

                    Session::put('total_price', $total_price);
                    Session::put('price', $price);

                    ?>
                    <ul class="list-inline">
                        <li style="margin-right:15px; display: inline">جمع کل خرید شما :</li>
                        <li style="float:left;margin-left:10px"><span
                                class="p1">{{ arabic_w2e( number_format($total_price)) }}</span>
                            تومان
                        </li>
                    </ul>
                </div>
                <div style="background:#F7FFF7;">
                    <ul class="list-inline">
                        <li style="margin-right:15px;color:#4CAF50;display: inline">مبلغ قابل
                            پرداخت :
                        </li>
                        <li style="float:left;color:#4CAF50;margin-left:10px"><span
                                class="p1">{{ arabic_w2e( number_format($price)) }}</span> تومان
                        </li>
                    </ul>
                </div>
            </div>


        </div>
        @endif
    </div>
</div>
@if(auth::check())
            <div class="btn-fixed">
            <a href="{{ url('Shipping') }}" class="btn btn-info-custom hvr-sweep-to-left"
               style="float:left;margin-top:15px;line-height: 44px"><span>ادامه ثبت سفارش</span>
                <span class="fa fa-arrow-left"></span></a>
            </div>
            @else
            <div class="btn-fixed">
            <button onclick="show_login_form()" style="float:left;margin-top:15px;line-height: 44px" class="btn btn-info-custom hvr-sweep-to-left">ادامه ثبت سفارش<span class="fa fa-arrow-left mr-3"></span></button>
            </div>
                  @endif
<div id="show_data"></div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h5 class="modal-title  text-center w-100 " id="myModalLabel">ورود به سایت</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary text-center" role="alert">
                    برای ادامه خرید لطفا وارد سایت شوید
                </div>
                <div class="register_form text-right">
                    <form method="post" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group w-100">
                                <label for="inputAddress">شماره همراه یا پست الکترونیک</label>
                                <input type="text" value="{{ old('username') }}" class="form-control" name="username"
                                    id="inputAddress">
                                
                                

                            </div>
                        </div>
                        @if($errors->has('username'))
                        <span class="has-error">{{ $errors->first('username') }}</span>
                        @endif


                        <div class="form-row">
                            <div class="form-group w-100">
                                <label for="inputPaswword">کلمه عبور</label>
                                <input type="password" class="form-control" name="password" id="inputPaswword">
                                
                                 
                            </div>
                        </div>
                        @if($errors->has('password'))
                        <span style="color: red;font-size: 10pt">{{ $errors->first('password') }}</span>
                        @endif
                        <div class="form-group custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck" name="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="custom-control-label" for="customCheck"> مرا به خاطر بسپار</label>
                        </div>

                        <div class="form-group text-center">
                            <input type="submit" style="width:150px" class="btn btn-info" value="ورود به سایت">
                            <a class="btn btn-light" style=" padding-right: 10px;" href="">بازیابی کلمه عبور</a>
                        </div>


                    </form>
                </div>


            </div>
            <div style="background-color: #dae1f1;" class="login_footer text-center">

                <span>ثبت نام نکرده اید؟</span>
                      
                <a class="btn btn-secondary  mb-1" href="{{ url('register') }}">ثبت نام نکرده اید؟</a>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
<?php
$url=url('site/ajax_del_cart');
$url2=url('site/ajax_change_cart');
?>

<script>
    change_number_cart_product=function (number,product_id,color_id,service_id)
    {
        $.ajaxSetup(
            {
                'headers':{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
        $(".loading_div").show();
        $.ajax({
            url:'{{ $url2 }}',
            type:'POST',
            data:'service_id='+service_id+'&product_id='+product_id+'&color_id='+color_id+'&number='+number,
            success:function (data) {
                $("#product_cart").html(data);
                $(".loading_div").hide();
            }
        });
    };
    del_product=function (p_id,s_id,c_id)
    {
        $.ajaxSetup(
            {
                'headers':{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
        $(".loading_div").show();
        $.ajax({
            url:'{{ $url }}',
            type:'POST',
            data:'service_id='+s_id+'&product_id='+p_id+'&color_id='+c_id,
            success:function (data) {
                $("#product_cart").html(data);
                $(".loading_div").hide();
            }
        });
    };
</script>

<?php
    $url1 = url('site/ajax_check_login');
    ?>
<script>
    show_login_form = function () {
            $.ajaxSetup(
                {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                url: '{{ $url1 }}',
                type: 'POST',
                success: function (data) {
                    $("#show_data").html(data);
                }
            });
        };

</script>
@if($errors->has('username') or $errors->has('password'))
<script>
    $("#myModal").modal('show');
</script>
@endif
@endsection