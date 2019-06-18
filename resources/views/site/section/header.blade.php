<nav style="background:white" class="navbar navbar-expand-md pb-4  pt-4">
    <a class="navbar-brand" href="/"><img src="{{URL::asset('/img/icon.gif')}}" width="40" height="40"> گروه<span> هیراد کویر </span></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <form style="width: 63%;position:relative" action="{{ url('Search') }}" id="search_product_form" class="form-inline mt-2 mt-md-0">

            <input id="inputGroupSuccess1" name="text" class="custom-form-control mr-sm-2" type="text" placeholder="نام کالا یا برند" aria-label="Search">
            <button style="" class=" custom-search  my-2 my-sm-0"></button>

        </form>
        <ul style="width: 187px !important;" class="navbar-nav list-inline nav-width-custom  p-0">
            @if(Auth::check())
            <div class="dropdown">
                <li class="mt-2 text-center  "><a class=" show-drop toggle" href="#">
                        {{ Auth::user()->username }}
                    </a>
                </li>
                <div class="user_drop dropdown-menu"> 
                    <a href="{{url('user')}}"><p><i class="fa fa-user"></i>پروفایل</p></a>
                    <a href="{{url('user/orders')}}"><p><i class="fa fa-shopping-cart"></i>سفارشات من </p></a>
                    <a href="{{url('logout')}}"><p><i class="fa fa-sign-out"></i>خروج از سایت </p></a>
                </div>
            </div>
            @else

                <li class="    mt-2 mr-3"><a class="user-list-sign" href="{{url('register')}}"><i class="fa fa-user-plus ml-2"></i>ثبت نام</a></li>
                <li  onclick="show_login_form()"  id="myBtn"class=" user-list-sign  mt-2 mr-4"> <i class="fa fa-sign-in ml-2"></i> ورود  </li>
            @endif
        </ul>
            <div class="cart-shop ">

                <a href="{{ url('Cart') }}">
                    <div class="btn-shopping-cart">
                        <div class="shopping-cart-icon"><span class="fa fa-shopping-cart"></span></div>
                        <div class="shopping-cart-text">
                            <span style="float:right">سبد خرید</span>
                            <span class="number-product-cart">{{ \App\Cart::count() }}</span>
                        </div>
                    </div>
                </a>

            </div>



    </div>
</nav>
<div id="show_data"></div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button style="position:absolute" type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
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
                                    <input type="text" value="{{ old('username') }}" class="form-control" name="username" id="inputAddress">
                                     
                                     

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
                    <a class="btn  mb-1" href="{{ url('register') }}">ثبت نام در سایت</a>
                </div>
            </div>
        </div>
    </div>

<div class="container-fluid menu">

    <div class="container">
        <div class="row">
            <ul class="list-inline" id="product_cat">
                @foreach($category as $key=>$value)

                    <li id="product_cat_li_<?= $value->id ?>">
                        <a href="{{ url('category').'/'.$value['cat_ename'] }}"><span
                                style="padding:7px">{{ $value['cat_name'] }}</span></a>
                        <span id="product_cat_span_<?= $value->id ?>"  </span>
                        <ul class="list-inline sub_menu1">
                            @foreach($value->getChild as $key2=>$value2)
                                <li>
                                    <a href="{{ url('category').'/'.$value->cat_ename.'/'.$value2->cat_ename }}">
                                        {{ $value2->cat_name }}
                                    </a>

                                    <div class="menu_box">


                                        <?php
                                        $t = 0;
                                        $d = 1;
                                        ?>

                                        @foreach($value2->getChild as $key3=>$value3)

                                            <?php

                                            $menu4 = $value3->getChild2;
                                            ?>
                                            @if((11-$t)<sizeof($menu4) && $t>0)

                                                <?php
                                                $t = 0;
                                                $d++;

                                                ?>
                                    </div>
                                    @endif
                                    @if($t==0)
                                        <div class="menu_box_div_{{ $d }}">
                                            @endif
                                            <?php $t++; ?>


                                            <ul class="li_menu">
                                                <li>
                                                    <a style="color:#16C1F3"
                                                       href="{{ url('category').'/'.$value->cat_ename.'/'.$value2->cat_ename.'/'.$value3->cat_ename }}">
                                                        {{ $value3->cat_name }}
                                                    </a>
                                                </li>
                                                <?php
                                                $j = 0;

                                                ?>
                                                @foreach($menu4 as $key4=>$value4)
                                                    <?php $t++; ?>
                                                    @if($j<11) <?php
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
                                                    <li><a
                                                            href="{{ $url }}">{{ $value4->cat_name }}</a>
                                                    </li>

                                                    @else

                                                        @if(sizeof($menu4)>11)

                                                            <li>
                                                                <a href="{{ url('category').'/'.$value->cat_ename.'/'.$value2->cat_ename.'/'.$value3->cat_ename }}"
                                                                   style="color:#16C1F3">مشاهده موارد بیشتر</a></li>
                                                        @endif

                                                    @endif

                                                    <?php $j++ ?>

                                                @endforeach

                                            </ul>


                                            <?php
                                            if($t > 12)
                                            {
                                            $t = 0;
                                            $d++;
                                            ?>
                                        </div><?php
                                        }

                                        ?>

                                        @endforeach



                                        @if(!empty($value2->img))

                                            <div class="cat_img"
                                                 style="background:url('{{ url('upload').'/'.$value2->img }}')"></div>
            @endif

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
