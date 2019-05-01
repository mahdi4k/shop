<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/custom.css">
    <title>lamino</title>
</head>
<body>

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
<section id="third-carousel">
    <div class="new-product">
        <div class="container">
            <div class="row">
                <div class=" featured-product-home">
                    <div class="title os-animation" data-os-animation="fadeIn" data-os-animation-delay=".25s">
                        <h2 class="text-center">اخرین محصولات </h2>
                    </div>


                    <div id="myCarousel-third" class="carousel slide" data-ride="carousel" data-interval="3000">
                        <ol class="carousel-indicators">
                            @foreach($products as $key=>$value)

                                <li data-target="#myCarousel-third" data-slide-to="{{$loop->index}}"
                                    class="{{$loop->first ? 'active' :''}}"></li>
                            @endforeach
                        </ol>


                        <div class="carousel-inner" role="listbox">
                            @foreach($products as $product)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">

                                    <div class="col-md-3">
                                        <div class="product shadow-around">
                                            <figure>
                                                <a href="#"><img class="imgres"
                                                                 src="{{ url('upload').'/'.$value->get_img->url }}"
                                                                 alt=""></a>

                                            </figure>
                                            <div class="product-content">
                                                <h2><a href="">Apple iPhone 5s</a></h2>

                                                <span class="price">۲.۵۰۰.۰۰۰ تومان</span>
                                                <a href="" class="   btn btn-info">افزودن به سبد</a>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="carousel-item">
                                    <div class="col-md-3">
                                        <div class="product shadow-around">
                                            <figure>
                                                <a href="#"><img class="imgres"
                                                                 src="{{URL::asset('/img/product1.jpg')}}"
                                                                 alt=""></a>

                                            </figure>
                                            <div class="product-content">
                                                <h2><a href="">Apple iPhone 5s</a></h2>

                                                <span class="price">۲.۵۰۰.۰۰۰ تومان</span>
                                                <a href="" class="btn btn-info">افزودن به سبد</a>
                                            </div>
                                        </div>
                                        `
                                    </div>


                                </div>
                                @endforeach()
                        </div>


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

            <div class="col-md-4">

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
<script
    src="https://code.jquery.com/jquery-3.4.0.min.js"
    integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
    crossorigin="anonymous">
</script>
<script src="js/easing.jquery1.3.min.js"></script>
<script src="js/custom.js"></script>
</body>

</html>
