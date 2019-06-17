<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{url('css/admin.css')}}">
    <link rel="stylesheet" href="{{url('css/custom.css')}}">
    <link rel="stylesheet" href="{{url('css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{url('css/flipclock.css')}}">
    <link rel="stylesheet" href="{{url('css/site.css')}}">
    <link rel="stylesheet" href="{{url('css/mobile.css')}}">
    <script src="{{url('js/home.js')}}"></script>



    @yield('style')
    <title>
        @yield('title')
    </title>
</head>

<body>
    <div class="w-100">
        <div class="cat_box" id="cat_box">


            <div class="col-xs-9" id="cat_list">


                <div class="cat_list_header">
                    <p>هوشمند خودرو|هیراد کویر</p>
                </div>
                <ul class="cat_list_ul">
                    @foreach($category as $key=>$value)
                    <li onclick="show_child_cat({{ $value->id }})"><span
                            style="padding-right:15px;">{{ $value->cat_name }}</span>
                        <span id="span_ic_{{ $value->id }}" class="fa fa-angle-down cat_angle"></span>
                        <ul id="child_ul_{{ $value->id }}">
                            @foreach($value->getChild as $key2=>$value2)
                            <li><a
                                    href="{{ url('category').'/'.$value->cat_ename.'/'.$value2->cat_ename }}"><span>{{ $value2->cat_name }}</span></a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>

            </div>
            <div class="col-xs-3" id="back_cat_list" onclick="hide_cat_box()"></div>
        </div>
        <div class="header text-right ">
            <ul class="list-inline" id="header_ul">
                <li class="list-inline-item" onclick="show_cat_box()"><span class="fa fa-bars"></span></li>
                <li class="list-inline-item">هوشمند خودرو</li>

                <a href="{{url('user')}}"><li class="list-inline-item pull-left ml-3"  ><span class="fa fa-user"></span></li></a>
                <a href="{{ url('Cart') }}"><li  class="list-inline-item pull-left ml-3" ><span class="fa fa-shopping-cart"></span></li></a>
                <li class="list-inline-item pull-left ml-3" ><span class="fa fa-search"></span></li>
                
                <li class="list-inline-item toggle-search w-100  ">
                        <form style="width: 100%;position:relative" action="{{ url('Search') }}" id="search_product_form" class="form-inline mt-2 mt-md-0">

                                <input id="inputGroupSuccess1" name="text" class="custom-form-control mr-sm-2" type="text" placeholder="نام کالا یا برند" aria-label="Search">
                                <button style="" class=" custom-search  my-2 my-sm-0"></button>
                    
                        </form>
                </li>
            </ul>
            
        </div>
        
    </div>
    <div class="clear"></div>
    
        @yield('content')
   
    <div class="w-100">
        <footer class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-8 text-center">
                    <div class=" sta-title col-sm-8 col-md-12 col-md-offset-2">
                        <p><i class="fa fa-phone-square"></i>ارتباط با ما</p>
                    </div>
                    <div class="clearfix"></div>
                    <ul class="site-sta">
                        <li><i class="fa fa-map-marker"></i>پارک علم و فناوری</li>
                        <li style="font-size: 16px;"><i class="fa fa-envelope"></i>info@hooshmandkhodro.com</li>
                        <li><i class="fa fa-phone"></i>۰۳۵۳-۸۴۱۲۰۱۶</li>

                    </ul>
                </div>

                <div class="col-md-6 col-sm-8 text-center">
                    <div class=" about-title col-sm-8 col-md-12 col-md-offset-2">
                        <p><i class="fa fa-users"></i>گروه هیراد</p>
                    </div>
                    <div class="clearfix"></div>
                    <p class="footer-about text-justify">طراحی نسل جدید سیستمهای چند رسانه ایی خودرو برپایة سیستم عامل اندروید.
                        در ابتدا با آپشن های موجود در بازار، تست کردن و رفع عیوب محصول، بعدازآن شروع به تولید و عرضه در بازار
                        میشود.به طور همزمان تحقیق و توسعه شرکت درجهت ارتقاء محصول و آپشن های اختصاصی گام برداشته شود.محصولات
                        ارائه شده در بازارایران کمتر درزمینه اندروید بوده درصورتی که علاقه مردم به سیستم های اندروید به دلیل
                        راحتی کاربا آن و ارتقاء دادن آن و همچنین طیف گسترده تر نرم افزارها و ارتباط برقرارکردن با اینترنت بیشتر
                        می باشد. </p>
                </div>

                <div class="col-md-6 col-sm-8 text-center">
                    <div class=" about-title col-sm-8 col-md-12 col-md-offset-2">
                        <p><i class="fa fa-th-list"></i>مجوز ها</p>
                    </div>
                    <div class="clearfix"></div>
                    <ul class="License">
                        <li class="list-inline-item"><i class="fa fa-image"></i> <a target="_blank" href=" /img/2.jpg ">مجوز فناوری</a></li>
                        <li class="list-inline-item"><i style="margin-left: 4px" class="fa fa-image"></i><a target="_blank" href=" /img/1.jpg ">مجوز
                                فعالیت</a></li>
                    </ul>
                    <img class="img-enamad" src="{{URL::asset('/img/enamad.png')}}">

                </div>
                <div class="col-md-6 col-sm-8 text-center">
                    <div class=" about-title col-sm-8 col-md-12 col-md-offset-2">
                        <p><i class="fa fa-bookmark-o"></i>شَبکه اجتماعی</p>
                    </div>
                    <div class="social-network">
                        <a href=""> <i class="fa fa-telegram"></i></a>
                        <a href=""> <i class="fa fa-instagram"></i></a>
                        <a href=""> <i class="fa fa-twitter"></i></a>
                        <a href=""> <i class="fa fa-facebook"></i></a>
                    </div>
                    <p class="text-center no-margin">عضویت در خبرنامه</p>
                    <input type="email" class="original-control" placeholder="ایمیل" aria-label="Username">
                    <button type="submit" class="btn pull-left inside-btn btn-primary">ارسال</button>
                </div>

            </div>
            <div class="row">
                <div class="col-xs-12 mt-3 col-md-12 footer-nav text-center">
                    <h5 class="text-center copy-right"> تمامی فعاليت‌هاي سایت، تابع قوانين و مقررات جمهوري اسلامي ايران می
                        باشد</h5>

                </div>
            </div>
        </footer>
    </div>
    <script src="{{url('js/js.js')}}"></script>
    <script src="{{url('js/slick.js')}}"></script>
    <script src="{{url('js/flipclock.min.js')}}"></script>
    <script src="{{url('js/mobile_js.js')}}"></script>
    <script src="{{url('js/easing.jquery1.3.min.js')}}"></script>

    @yield('script')
</body>

</html>
