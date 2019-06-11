@extends('site.master')
@section('style')
    <link rel="stylesheet" href="{{url('css/site.css')}}">
@endsection
@section('title')
    سبد خرید | فروشگاه اینترنتی هوشمند خودرو
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row content_box">

            <div class="  w-100" id="product_cart">

                <?php

                $cart_date = \App\Cart::get();

                function arabic_w2e($str)
                {
                    $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
                    $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
                    return str_replace($arabic_western, $arabic_eastern, $str);
                }
                ?>

                @if(sizeof($cart_date)==0)

                    <p style="color:red;text-align:center;padding-top:30px;padding-bottom: 20px;">سبد خرید شما خالی
                        می باشد</p>

                @else

                    <div style="width:95%;margin: 50px auto;text-align: right">

                        <p><span class="icon_item_name"></span> <span>سبد خرید </span></p>


                        <div style="clear: both;"></div>
                        <table id="cart_table" class="table  col-md-8">

                        <tr>
                            <th colspan="2">شرح محصول</th>
                            <th>تعداد</th>
                            <th>قیمت واحد</th>
                            <th colspan="2">قیمت کل</th>
                        </tr>
                                <?php
                                $total_price = 0;
                                $price = 0;
                                $j = 1;
                                ?>
                                @foreach($cart_date as $key=>$value)

                                    <?php

                                    $product_data = array_key_exists('product_data', $value) ? $value['product_data'] : array();

                                    ?>
                                    @foreach($product_data as $key2=>$value2)
                                        <?php
                                        $s_c = explode('_', $key2);
                                        $service_id = $s_c[0];
                                        $color_id = $s_c[1];
                                        $data = \App\Cart::get_date($key, $service_id, $color_id);
                                        ?>
                                        @if($data)

                                            <tr>

                                                <td class="last">
                                                    <div>
                                                        <span
                                                            onclick="del_product('{{ $key }}','{{ $s_c[0] }}','{{ $s_c[1] }}')"
                                                            class="fa fa-remove"></span>
                                                    </div>
                                                </td>
                                                <td>

                                                    <div style="width:100%" class="cart_div">
                                                        <div class="col-md-4">
                                                            <img class="cart_img" src="{{ $data['img'] }}">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <p>
                                                                <a href="{{ url('product').'/'.$data['code_url'].'/'.$data['title_url'] }}">{{ $data['title'] }}</a>
                                                            </p>
                                                            <p>
                                                                <a href="{{ url('product').'/'.$data['code_url'].'/'.$data['title_url'] }}">{{ $data['code'] }}</a>
                                                            </p>
                                                            @if(!empty($data['color_name']))
                                                                <p style="color:#777">
                                                                    <span>رنگ : </span>
                                                                    <label style="background:#{{ $data['color_code'] }}"
                                                                           class="color_product"></label>
                                                                    <span
                                                                        style="padding-right: 5px;">{{ $data['color_name'] }}</span>
                                                                </p>
                                                            @endif
                                                            @if(!empty($data['service_name']))
                                                                <p style="color:#777">
                                                                    <span>گارانتی : </span> {{ $data['service_name'] }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="styled_select">
                                                    <select id="number_product_{{ $j }}"
                                                            onchange="set_number_product('{{ $key }}','{{ $s_c[0] }}','{{ $s_c[1] }}','{{ $j }}')">
                                                        @for($i=1;$i<31;$i++)
                                                            <option @if($value2==$i) selected="selected"
                                                                    @endif  value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </td>
                                                <td class="cart_price">
                                                    <p>
                                                        <span
                                                            class="p1">{{ arabic_w2e( number_format($data['price2']))}}</span>
                                                        <span class="p2">تومان</span>
                                                    </p>
                                                </td>
                                                <td class="cart_price">
                                                    <p>
                                                        <span
                                                            class="p1">{{ arabic_w2e( number_format($data['price2']*$value2)) }}</span>
                                                        <span class="p2">تومان</span>
                                                    </p>
                                                </td>

                                            </tr>
                                                    </div>
                            <?php
                            $total_price += $data['price1'] * $value2;
                            $price += $data['price2'] * $value2;
                            ?>
                            <?php $j++; ?>
                            @endif

                            @endforeach

                            @endforeach

                        </table>


                        <div style="width:100%;" id="footer_cart">


                            <div class="col-md-4">
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
                                @if(auth::check())
                                <a href="{{ url('Shipping') }}" class="btn btn-info-custom hvr-sweep-to-left"
                                   style="float:left;margin-top:15px;margin-bottom: 30px;line-height: 44px"><span>ادامه ثبت سفارش</span>
                                    <span class="fa fa-arrow-left"></span></a>

                                @else
                                <button onclick="show_login_form()" style="float:left;margin-top:15px;margin-bottom: 30px;line-height: 44px" class="btn btn-info-custom hvr-sweep-to-left">ادامه ثبت سفارش<span class="fa fa-arrow-left mr-3"></span></button>
                                     
                                 @endif

                            </div>
                        </div>

                    </div>




                @endif
            </div>
        </div>
    </div>
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

                                    <input type="text" value="{{ old('username') }}" class="form-control" name="username" id="inputAddress">
                                     <label for="inputAddress">شماره همراه یا پست الکترونیک</label>
                                    <div class="line"></div>

                                </div>
                            </div>
                            @if($errors->has('username'))
                                <span class="has-error">{{ $errors->first('username') }}</span>
                            @endif


                            <div class="form-row">
                                <div class="form-group w-100">

                                    <input type="password" class="form-control" name="password" id="inputPaswword">
                                    <label for="inputPaswword">کلمه عبور</label>
                                    <div class="line"></div>
                                </div>
                            </div>
                            @if($errors->has('password'))
                                <span style="color: red;font-size: 10pt">{{ $errors->first('password') }}</span>
                            @endif
                            <div class="form-group custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck"
                                       name="remember" {{ old('remember') ? 'checked' : '' }}>

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

                      <span>
            قبلاً در سایت ثبت نام نکرده اید؟</span>
                    <a class="btn btn-secondary  mb-1" href="{{ url('register') }}">ثبت نام در سایت</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_site')
    <script>
        <?php
            $url = url('site/ajax_del_cart');
            $url2 = url('site/ajax_change_cart');
            ?>
            del_product = function (p_id, s_id, c_id) {
            $.ajaxSetup(
                {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                url: '{{ $url }}',
                type: 'POST',
                data: 'service_id=' + s_id + '&product_id=' + p_id + '&color_id=' + c_id,
                success: function (data) {
                    $("#product_cart").html(data);
                }
            });
        };
        set_number_product = function (p_id, s_id, c_id, id) {
            var number = document.getElementById('number_product_' + id);
            if (number) {
                number = number.value;
                $.ajaxSetup(
                    {
                        'headers': {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                $.ajax({
                    url: '{{ $url2 }}',
                    type: 'POST',
                    data: 'service_id=' + s_id + '&product_id=' + p_id + '&color_id=' + c_id + '&number=' + number,
                    success: function (data) {
                        $("#product_cart").html(data);
                    }
                });
            }
        }
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
