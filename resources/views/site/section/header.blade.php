<?php
   
   $cart_date = \App\Cart::get();


   ?>

<div  class="w-100 top-nav d-flex justify-content-center">
    <ul style="background: #4c4f569e;padding-top: 7px;height: 31px;margin-top: 0;font-size: 13px;" class="list-inline text-center">
        <li style="color:white" class="list-inline-item">شماره تماس : </li>
        <li class="list-inline-item">
            
             
        </li>
        <li style="position: relative; left: 9px;top: 1px;"  class="list-inline-item">
        <span style="color:white">۳۵۳-۷۲۲۲۲۲۲۲ </span>
        
        <i style="padding-left: 6px;position: relative;color: coral;right: 2px;" class="fa fa-phone"></i>
        </li>
    </ul>
</div>
<nav style="background:#fdfdfd" class="navbar navbar-expand-md pb-2  pt-2">
    <a class="navbar-brand" href="/"><img width="80"  src="{{URL::asset('/img/Untitled-3.gif')}}" > </a> 
             

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
        <form style="width: 63%;position:relative" action="{{ url('Search') }}" id="search_product_form"
            class="form-inline mt-2 focus-effect  mt-md-0">

            <input id="inputGroupSuccess1" name="text" class="custom-form-control  mr-sm-2" type="text"
                placeholder="نام کالا یا برند" aria-label="Search">
            <button style="cursor:pointer" type="submit" class=" custom-search  my-2 my-sm-0"></button>

        </form>
        <ul style="width: 187px !important;" class="navbar-nav list-inline nav-width-custom  p-0">
            @if(Auth::check())
            <div class="dropdown">
                <li class="mt-2 text-center  "><a class=" show-drop toggle" href="#">
                        {{ Auth::user()->username }}
                    </a>
                </li>
                <div class="user_drop dropdown-menu">
                    <a href="{{url('user')}}">
                        <p><i class="fa fa-user"></i>پروفایل</p>
                    </a>
                    <a href="{{url('user/orders')}}">
                        <p><i class="fa fa-shopping-cart"></i>سفارشات من </p>
                    </a>
                    <a href="{{url('logout')}}">
                        <p><i class="fa fa-sign-out"></i>خروج از سایت </p>
                    </a>
                </div>
            </div>
            @else

            <li class="mt-2 mr-3"><a class="user-list-sign" href="{{url('register')}}"><i style="color:skyblue;"
                        class="fa fa-user-plus ml-2"></i>ثبت نام</a></li>
            <li onclick="show_login_form()" id="myBtn" class=" user-list-sign  mt-2 mr-4"> <i
                    style="color:skyblue;margin-left:2px !important;margin-top: 1px !important;position: relative;top: 3px;"
                    class="fa fa-sign-in ml-2"></i> ورود </li>
            @endif
        </ul>
        <div class="cart-shop  ">
            <div id="show-mini-cart" class="test-shine">
                <img style="width:50px; border-radius:300px" src="{{url('img/minicart.jpeg')}}">
                <span class="number-product-cart">{{ \App\Cart::count() }}</span>
            </div>

            <div class="table-responsive cart">
                @if(sizeof($cart_date)==0)
                <p class="cart-empty">هیچ کالایی در سبد خرید شما وجود ندارد!</p>
                @else
                <div id="delete-mini-cart">
                    <table class="table shadow-around">
                        @php
                        $total_price = 0;
                        $price = 0;
                        $j = 1;
                        @endphp
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
                        <?php
                 $total_price += $data['price1'] * $value2;
                 $price += $data['price2'] * $value2;
                 ?>
                        <?php
 
                 Session::put('total_price', $total_price);
                 Session::put('price', $price);
 
                 ?>
                        @endforeach
                        @endforeach

                        <tbody>
                            <tr class="table-body">
                                <td class="text-center color-mini-cart" colspan="2"><span class="price-cart-final ">قیمت
                                        کل :
                                    </span><span class="pink">{{   number_format($total_price)  }}</span>
                                </td>

                                <td style="padding: 6px 11px;" colspan="2"><a href="{{url('Cart')}}"
                                        class="btn btn-cart" href=""><span class="color-mini-cart">مشاهده سبد
                                            خرید</span></a>
                                </td>

                            </tr>
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

                            <tr class="table-body">
                                <td class="cart-image ">
                                    <a href="{{ url('product').'/'.$data['code_url'].'/'.$data['title_url'] }}">
                                        <figure><img src="{{ $data['img'] }}"></figure>
                                    </a>
                                </td>
                                <td style="padding:0">
                                    <a class="color-mini-cart"
                                        href="{{ url('product').'/'.$data['code_url'].'/'.$data['title_url'] }}">
                                        <h6>{{ str_limit($data['title'],12) }}</h6>
                                    </a>
                                </td>
                                <td>
                                    <span class="cart-price color-mini-cart">
                                        {{  number_format($data['price2'])}} تومان
                                    </span>

                                </td>
                                <td>
                                    <span onclick="del_product_cart('{{ $key }}','{{ $s_c[0] }}','{{ $s_c[1] }}')">
                                        <i style="color:#9a9797" class="fa fa-trash"></i>
                                    </span>

                                </td>

                            </tr>


                            @endforeach
                            @endforeach
                            <tr class="table-body">
                                <td style="padding:3px" colspan="4">
                                <a href="{{url('Shipping')}}" style="color:white !important"
                                        class="btn btn-block btn btn-info-custom-mini-cart hvr-sweep-to-left ">ثبت سفارش
                                        وارسال
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>



    </div>
</nav>
<div id="show_data"></div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button style="position:absolute" type="button" class="close" data-dismiss="modal"
                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title  text-center w-100 " id="myModalLabel">ورود به سایت</h5>
            </div>
            @if (Request::is('Cart'))
            <div class="modal-body">
                <div style="margin-bottom:0" class="alert alert-primary text-center" role="alert">
                    برای ادامه خرید لطفا وارد سایت شوید
                </div>
            </div>
            @endif
            <div class="modal-body">



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
                            <a class="btn btn-light" style=" padding-right: 10px;"
                                href="{{route('password.request')}}">بازیابی کلمه عبور</a>
                        </div>


                    </form>
                </div>


            </div>
            <div style="background-color: #dae1f1;" class="login_footer text-center">

                <span>
                    قبلاً در سایت ثبت نام نکرده اید؟</span>
                <a class="btn  mb-1 btn-outline-success" href="{{ url('register') }}">ثبت نام در سایت</a>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid menu">

    <div class="container">
        <div class="row">

            <div id="menu_top" style="width: 1250px; height: 40px;">
                <ul style="margin-top:7px;" class="list-inline d-flex ">
                    @foreach($category as $key=>$value)

                    <li class=" list-inline-item justify-content-around" data-time="<?= $value->id ?>">
                        <a href="{{ url('category').'/'.$value['cat_ename'] }}"><span
                                class="menu_down_icon">{{ $value['cat_name'] }}</span></a>

                        <ul>
                            @foreach($value->getChild as $key2=>$value2)
                            <li class=" list-inline-item" data-time="<?= $value2->id ?>">
                                <a href="{{ url('category').'/'.$value->cat_ename.'/'.$value2->cat_ename }}">
                                    {{ $value2->cat_name }}
                                </a>
                                <div class="submenue3"
                                    style="width: 1150px; height: 370px;background: #ffffff;border-top: 1px solid #eeeeee; position: absolute; right: 0">

                                    <div class="top_menu3_col">
                                        <ul class="top_menu3_col_ul list-group">
                                            <?php
                                                $i=1;
                                                $b=1;
                                            ?>
                                            @foreach($value2->getChild as $key3=>$value3)
                                            <?php
                                            $menu4 = $value3->getChild2;
                                          ?>
                                             <li class="list-group-item text-right">
                                                <a class="submenu-style"
                                                    href="{{ url('category').'/'.$value->cat_ename.'/'.$value2->cat_ename.'/'.$value3->cat_ename }}">
                                                    {{ $value3->cat_name }}
                                                </a>
                                            </li>
                                            

                                            <li >
                                                @foreach ($menu4 as $key4=>$value4)
                                                <?php
                                                $url = url('/');
                                                $e = explode('_', $value4->cat_ename);
                                                if (sizeof($e) == 3) {
                                                    if ($e[0] == 'filter') {
                                                        $url .= '/search/' . $value->cat_ename . '/' . $value2->cat_ename . '/' . $value3->cat_ename . '?' . $e[1] . '[0]=' . $e[2];
                                                    } else {
                                                        $url .= '/category/' . $value->cat_ename . '/' . $value2->cat_ename . '/' . $value3->cat_ename . '/' . $value4->cat_ename;
                                                    }
                                                } else {
                                                    $url .= '/category/' . $value->cat_ename . '/' . $value2->cat_ename . '/' . $value3->cat_ename . '/' . $value4->cat_ename;
                                                }
                                                ?> 
                                                 <a class="d-flex submenu-style-a" href="{{ $url }}">{{ $value4->cat_name }}</a>  
                                                 @if($b++ == 4)
                                                 @break
                                                  @endif
                                                @endforeach
                                                
                                            </li>
                                            @if($i++ == 2)
                                                @break
                                            @endif
                                            @endforeach
                                        </ul>

                                    </div>
                                    
                                    <div class="top_menu3_col">
                                            <ul class="top_menu3_col_ul list-group">
                                                    <?php
                                                         $b=1;
                                                    ?>
                                                    @foreach($value2->getChild as $key3=>$value3)
                                                     @if($key3>2 && $key3<5)
                                                    <?php
                                                    $menu4 = $value3->getChild2;
                                                  ?>
                                                     <li class="list-group-item text-right">
                                                        <a class="submenu-style"
                                                            href="{{ url('category').'/'.$value->cat_ename.'/'.$value2->cat_ename.'/'.$value3->cat_ename }}">
                                                            {{ $value3->cat_name }}
                                                        </a>
                                                    </li>
                                                    
        
                                                    <li >
                                                        @foreach ($menu4 as $key4=>$value4)
                                                        <?php
                                                        $url = url('/');
                                                        $e = explode('_', $value4->cat_ename);
                                                        if (sizeof($e) == 3) {
                                                            if ($e[0] == 'filter') {
                                                                $url .= '/search/' . $value->cat_ename . '/' . $value2->cat_ename . '/' . $value3->cat_ename . '?' . $e[1] . '[0]=' . $e[2];
                                                            } else {
                                                                $url .= '/category/' . $value->cat_ename . '/' . $value2->cat_ename . '/' . $value3->cat_ename . '/' . $value4->cat_ename;
                                                            }
                                                        } else {
                                                            $url .= '/category/' . $value->cat_ename . '/' . $value2->cat_ename . '/' . $value3->cat_ename . '/' . $value4->cat_ename;
                                                        }
                                                        ?> 
                                                         <a class="d-flex submenu-style-a" href="{{ $url }}">{{ $value4->cat_name }}</a>  
                                                         @if($b++ == 4)
                                                         @break
                                                          @endif
                                                        @endforeach
                                                        
                                                    </li>
                                                     
                                                   @endif  
                                                  @endforeach
                                            </ul>
                                    </div>
                                    <div class="top_menu3_col"></div>

                                    {{--<img   width="379" height="335"
                                        style="position: absolute;;left: 2px;bottom: 2px;">--}}
                                </div>
                            </li>

                            @endforeach
                        </ul>

                    </li>


                    @endforeach
                </ul>


            </div>
        </div>
    </div>
</div>