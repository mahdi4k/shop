<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel="stylesheet" href="css/flipclock.css">

    <title>lamino</title>
</head>
<body>
<?php
function arabic_w2e($str)
{
    $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    return str_replace($arabic_western, $arabic_eastern, $str);
}

?>
<nav class="navbar    navbar-fixed-top navbar-expand-md navbar-dark" id="banner">
    <div class="container">
        <div class="row">
            <!-- Brand -->
            <a class="navbar-brand" href=""><img src="{{URL::asset('/img/icon.gif')}}" width="40" height="40"> گروه
                <span> هیراد کویر </span></a>

            <!-- Toggler/collapsibe Button -->
            <button class=" navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#about">خدمات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#third-carousel">محصولات </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#we-are">تماس با ما</a>
                    </li>
                    <!-- Dropdown -->

                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="clearfix"></div>
<div class="banner">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <p> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحاسوالات پیوسته اهل
                    دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
                <button type="button" class="btn btn-outline-light">خرید کنید</button>
            </div>
            <div class="col-md-6">

                <img class="imgres animated  fadeInLeftBig  "
                     src="{{URL::asset('img/computer2.png')}}">
            </div>
        </div>
    </div>
</div>

<section id="about">
    <div class="container">
        <h1 class="text-center">معرفی <span>مهارت های</span> ما</h1>
        <div class="row">

            <div class="col-md-3 col-xs-6 image-rotate">
                <span class="big_rounded_icon centered centered after heading_icon1 animated icon-magic loaded1"></span>
                <h3 class="text-center">طراحی سه بعدی با پرینتر سه بعدی</h3>
            </div>
            <div class="col-md-3 col-xs-6 image-rotate  ">
                <span class="big_rounded_icon centered centered after heading_icon2 animated icon-magic loaded2"></span>
                <h3 class="text-center">طراحی مدار های مخابراتی و فرکانس بالا</h3>
            </div>

            <div class="col-md-3 col-xs-6 image-rotate">
                <span class="big_rounded_icon centered centered after heading_icon3 animated icon-magic loaded3"></span>
                <h3 class="text-center">طراحی برد مدار چاپی چند لایه</h3>
            </div>

            <div class="col-md-3 col-xs-6 image-rotate">
                <span class="big_rounded_icon centered centered after heading_icon4 animated icon-magic loaded4"></span>
                <h3 class="text-center">طراحی وب سایت همراه با اپ اندرویدی</h3>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<section id="amazing">

    <div class="container-fluid">

        @if(sizeof($amazing)>0)

            <?php

            $array=array(
                6=>'هزار تومان',
                7=>'میلیون تومان'
            )

            ?>

            @foreach($amazing as $key=>$value)


                <?php

                $url=url('').'/product/';
                if($value->get_product)
                {
                    $url.=$value->get_product->code_url.'/'.$value->get_product->title_url;
                }
                ?>

                <a href="{{ $url }}">
                    <div class="amazing_div" id="amazing_div_{{ $key }}" @if($key==0) style="display:block" @endif>

                        <div class="col-md-5">
                            <p style="color:red;padding-top: 30px;">پيشنهاد شگفت انگيز امروز</p>

                            <span class="price1">
                                        <?php
                                $price1=str_replace('000','',$value->price1);
                                ?>
                                {{ number_format($price1) }}
                                    </span>


                            <span class="price2">
                                        <?php
                                $price2=str_replace('000','',$value->price1-$value->price2);
                                $price3=$value->price1-$value->price2;
                                ?>
                                {{ number_format($price2) }}<span style="padding-right:5px;"></span> {{ array_key_exists(strlen($price3),$array) ? $array[strlen($price3)] : '' }}
                                    </span>
                            <div style="margin-top: 20px;">
                                {!!   nl2br($value->tozihat) !!}
                            </div>

                            <p style="padding-top: 25px;">
                                فرصت باقی مانده تا این پیشنهاد
                            </p>
                            <div class="clock" id="amazing_clock_{{ $key }}">

                            </div>


                            <div class="Finished_Badge" id="amazing_img_{{ $key }}" style="display:none">
                                <img src="{{ url('img/Finished_Badge.png') }}">
                            </div>

                        </div>


                        <div class="col-md-7">

                            <p style="text-align:center;padding-top:30px">{{ $value->title }}</p>

                            @if($value->get_img)
                                <div style="width:250px;margin:auto">
                                    <img style="width:100%" src="{{ url('upload').'/'.$value->get_img->url }}">

                                </div>
                            @endif
                        </div>
                    </div>
                </a>




            @endforeach


            <div class="amazing_box">

                <section class="amazing">

                    @foreach($amazing as $key=>$value)

                        <div class="amazing_footer"  id="amazing_footer_{{ $key }}"  onclick="show_amazing({{ $key }},{{ sizeof($amazing) }})">
                            <span class="ab3"></span> {{ $value->m_title }}
                        </div>

                    @endforeach

                </section>

            </div>
        @endif

    </div>


</section>


<section id="third-carousel">
    <div class="new-product">
        <div class="container">
            <div class="row">
                <div class=" featured-product-home">
                    <div class="title order-title  ">
                        <h2 class="text-center">جدیدترین محصولات</h2>
                    </div>


                    <div class="shop_product">


                        <section class="new_product">
                            @foreach($product as $key=>$value)
                                <div class="product_box">

                                    @if($value->get_img)

                                        <div class="product_image_box">
                                            <img src="{{ url('upload').'/'.$value->get_img->url }}">
                                        </div>

                                    @endif


                                    <p>
                                        <a href="{{ url('product').'/'.$value->code_url.'/'.$value->title_url }}">
                                            @if(strlen($value->title)>50)
                                                {{ mb_substr($value->title,0,33).' ... ' }}
                                            @else
                                                {{ $value->title }}
                                            @endif
                                        </a>
                                    </p>
                                    <p class="product_discounts"
                                       @if(!empty($value->discounts) && !empty($value->price)) style="background: #F5F6F7;" @endif>

                                        @if(!empty($value->discounts) && !empty($value->price))
                                            {{ arabic_w2e( number_format($value->price)) }} تومان
                                        @endif

                                    </p>


                                    <p class="product_price">
                                        @if(!empty($value->discounts) && !empty($value->price))

                                            {{ arabic_w2e( number_format($value->price - $value->discounts)) }} تومان
                                        @elseif(!empty($value->price))

                                            {{ arabic_w2e( number_format($value->price)) }} تومان
                                        @endif

                                    </p>
                                </div>
                            @endforeach
                        </section>


                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
<section id="we-are">
    <div class="container-fluid">
        <h1 class="text-center">گروه<span class="yellow"> هیراد</span> کویر</h1>
        <div class="row">

            <div class="col-md-4 ">

                <img class="imgres img-weare" src="{{URL::asset('/img/smart-workplace-100539537-primary.idge.jpg')}}"
                     width="485" height="377">

            </div>

            <div class="col-md-8">
                <h2 class="custom-text-weare">
                    طراحی نسل جدید سیستمهای چند رسانه ایی خودرو برپایة سیستم عامل اندروید. در ابتدا با آپشن های موجود در
                    بازار، تست کردن و رفع عیوب محصول، بعدازآن شروع به تولید و عرضه در بازار میشود.به طور همزمان تحقیق و
                    توسعه شرکت درجهت ارتقاء محصول و آپشن های اختصاصی گام برداشته شود.محصولات ارائه شده در بازارایران
                    کمتر درزمینه اندروید بوده درصورتی که علاقه مردم به سیستم های اندروید به دلیل راحتی کاربا آن و ارتقاء
                    دادن آن و همچنین طیف گسترده تر نرم افزارها و ارتباط برقرارکردن با اینترنت بیشتر می باشد.
                </h2>


                <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
                <div class="wrapper">
                    <div class="container">
                        <h1 class="text-center">فرم تماس با ما</h1>
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="email" class="form-control" id="inputEmail4">
                                    <label for="inputEmail4">ایمیل</label>
                                    <div class="line"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="inputname">
                                    <label for="inputname">نام و نام خانوداگی</label>
                                    <div class="line"></div>
                                </div>
                            </div>


                            <div class="form-group">
                                <textarea class="form-control" rows="8"></textarea>
                                <label class="pull-right">متن پیام</label>
                                <div class="line"></div>
                            </div>
                            <button type="button" class="btn btn-block btn-metrial">ارسال</button>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>

<footer class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-sm-8">
            <div class=" sta-title col-sm-8 col-md-4 col-md-offset-2">
                <p><i class="fa fa-phone-square"></i>ارتباط با ما</p>
            </div>
            <div class="clearfix"></div>
            <ul class="site-sta">
                <li><i class="fa fa-map-marker"></i>پارک علم و فناوری</li>
                <li style="font-size: 16px;"><i class="fa fa-envelope"></i>info@hooshmandkhodro.com</li>
                <li><i class="fa fa-phone"></i>۰۳۵۳-۸۴۱۲۰۱۶</li>

            </ul>
        </div>

        <div class="col-md-3 col-sm-8">
            <div class=" about-title col-sm-8 col-md-4 col-md-offset-2">
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

        <div class="col-md-3 col-sm-8">
            <div class=" about-title col-sm-8 col-md-4 col-md-offset-2">
                <p><i class="fa fa-th-list"></i>مجوز ها</p>
            </div>
            <div class="clearfix"></div>
            <ul class="License">
                <li><i class="fa fa-image"></i> <a target="_blank" href=" /img/2.jpg ">مجوز فناوری</a></li>
                <li><i style="margin-left: 4px" class="fa fa-image"></i><a target="_blank" href=" /img/1.jpg ">مجوز
                        فعالیت</a></li>
            </ul>
            <img class="img-enamad" src="{{URL::asset('/img/enamad.png')}}">

        </div>
        <div class="col-md-3 col-sm-8">
            <div class=" about-title col-sm-8 col-md-4 col-md-offset-2">
                <p><i class="fa fa-bookmark-o"></i>شَبکه اجتماعی</p>
            </div>
            <div class="social-network">
                <a href=""> <i class="fab fa-telegram"></i></a>
                <a href=""> <i class="fab fa-instagram"></i></a>
                <a href=""> <i class="fab fa-twitter"></i></a>
                <a href=""> <i class="fab fa-facebook"></i></a>
            </div>
            <p class="text-center no-margin">عضویت در خبرنامه</p>
            <input type="email" class="original-control" placeholder="ایمیل" aria-label="Username">
            <button type="submit" class="btn inside-btn btn-primary">ارسال</button>
        </div>

    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12 footer-nav">
            <h5 class="text-center copy-right"> تمامی فعاليت‌هاي سایت، تابع قوانين و مقررات جمهوري اسلامي ايران می
                باشد</h5>

        </div>
    </div>
</footer>

<script src="js/admin.js"></script>
<script src="js/jquery.min.js"></script>

<script src="js/js.js"></script>
<script src="js/slick.js"></script>
<script src="js/flipclock.min.js"></script>
<script>

    $('.amazing').slick({
        rtl:true,
        speed: 900,
        slidesToShow: 3,
        slidesToScroll:2,
        variableWidth:true,
        infinite: false
    });
</script></script>
<script>

    var amazing_time = [];
    var i = 0;

    <?php

        foreach ($amazing as $key=>$value)
        {
        $time = ($value->timestamp - time() > 0) ? $value->timestamp - time() : 0;
        ?>
        amazing_time[i] = <?= $time ?>;
    i++;
    <?php
    }

    ?>
    $('.new_product').slick({
        infinite: true,
        dots: true,
        speed: 1000,
        slidesToShow: 4,
        slidesToScroll: 4,
        rtl: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });


    for (var j = 0; j < amazing_time.length; j++) {
        var clock;

        clock = $('#amazing_clock_' + j).FlipClock({
            clockFace: 'HourlyCounter',
            autoStart: false,
            id: 'c_' + j,
            callbacks: {
                stop: function () {
                    var a = this.id.replace('c_', '');
                    $('#amazing_clock_' + a).hide();
                    $('#amazing_img_' + a).show();
                }
            }
        });

        clock.setTime(amazing_time[j]);
        clock.setCountdown(true);
        clock.start();
    }


</script>
<script src="js/easing.jquery1.3.min.js"></script>
<script src="js/custom.js"></script>
</body>

</html>
