@extends('mobile.layout')
@section('title')
    هوشمند خودرو
@endsection
@section('content')
<?php
function arabic_w2e($str)
{
    $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    return str_replace($arabic_western, $arabic_eastern, $str);
}

function get_amazing_time($old_amazing)
       {
           $array=array();
           $timestamp=0;
           $time=0;
           if($old_amazing)
           {
                   $timestamp=$old_amazing->timestamp;
           }
           if($timestamp>time())
           {
               $time=$timestamp-time();

               $h_t=$time/3600;
               $h=floor($h_t);
               $array[0]=$h;

               $m_t=$time-$h*3600;

               $m_t=$m_t/60;
               $m=floor($m_t);
               $array[1]=$m;
               return $array;
           }

       }
?>

<div class="banner col-md-12">


    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="row">
        <div class="col-md-12">
            <div class="carousel-inner">
                @foreach($slider as $slide)
                <div class="carousel-item  @if($loop->first) active @endif">
                    <img style="border-radius:17px"   class="img-fluid px-2"
                        src="{{ url('upload').'/'.$slide->img }}"
                        alt="First slide">
                 </div>

                @endforeach
            </div>
        </div>
        </div>

    </div>

</div>

 
<section id="about">
    <div class="container">
        <h1 class="text-center">معرفی <span>مهارت های</span> ما</h1>
        <div class="row">

            <div class="col-md-3 col-xs-3 image-rotate text-center">
                <span class="big_rounded_icon centered centered after heading_icon1 animated icon-magic loaded1"></span>
                <h3 class="text-center">طراحی با پرینتر سه بعدی</h3>
            </div>
            <div class="col-md-3 col-xs-3 image-rotate text-center  ">
                <span class="big_rounded_icon centered centered after heading_icon2 animated icon-magic loaded2"></span>
                <h3 class="text-center">  طراحی مدار های مخابراتی</h3>
            </div>

            <div class="col-md-3 col-xs-3 image-rotate text-center">
                <span class="big_rounded_icon centered centered after heading_icon3 animated icon-magic loaded3"></span>
                <h3 class="text-center">طراحی برد مدار چاپی چند لایه</h3>
            </div>

            <div class="col-md-3 col-xs-3 image-rotate text-center">
                <span class="big_rounded_icon centered centered after heading_icon4 animated icon-magic loaded4"></span>
                <h3 class="text-center">طراحی وب سایت</h3>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>


@if(is_array($amazing))
            @if(sizeof($amazing)>0)
                <?php

                $array=array(
                    6=>'هزار تومان',
                    7=>'میلیون تومان'
                );
                $a_time=get_amazing_time($old_amazing);
                ?>
                <div class="amazing_box">

                    @if( !$a_time || sizeof($a_time)==2)
                        <div style="float:right;max-width:150px;padding-top:15px;font-size:13px;padding-right:5px">
                            فرصت باقی مانده برای پیشنهادات
                        </div>
                        <ul class="list-inline amazing_ul">


                            <li>
                                <div class="timer">
                                    <span>{{ $a_time[0] }}</span>
                                    <span>ساعت</span>
                                </div>
                            </li>

                            <li class="ic_amazing">
                                <div>
                                    <div class="amazing_circle"></div>
                                    <div class="amazing_circle"></div>
                                </div>
                            </li>

                            <li>
                                <div class="timer">
                                    <span>{{ $a_time[1] }}</span>
                                    <span>دقیقه</span>
                                </div>
                            </li>
                        </ul>
                    @endif
                    <div>




                        <section class="amazing_product">
                            @foreach($amazing as $key=>$value)

                                <?php

                                $url=url('').'/product/';
                                $products=$value->get_product;
                                if($products)
                                {
                                    $url.=$products->code_url.'/'.$products->title_url;
                                }
                                $t=$value->timestamp-time();
                                ?>
                                <div class="amazing_product_box" >

                                    <p class="m_title">
                                        <a href="{{ $url }}">
                                            {{ $value->m_title }}
                                        </a>
                                    </p>
                                    @if($value->get_img)

                                        @if($t<0)
                                            <div class="Finished_Badge">
                                                <img  src="{{ url('images/Finished_Badge.png') }}">
                                            </div>


                                            <div class="incredible__finishEffect"></div>
                                        @endif

                                        <div class="product_image_box"  >
                                            <img src="{{ url('upload').'/'.$value->get_img->url }}">
                                        </div>


                                    @endif

                                    <p style="text-align:center;margin-top:15px;margin-bottom: 25px;position:relative">
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
                                    </p>
                                </div>




                            @endforeach
                        </section>


                    </div>

                </div>

            @endif
        @endif


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
<a href="{{ url('product').'/'.$value->code_url.'/'.$value->title_url }}">
                                <div class="product_image_box">
                                    <img src="{{ url('upload').'/'.$value->get_img->url }}">
                                </div>
                            </a>
                                @endif


                                <p>
                                    <a href="{{ url('product').'/'.$value->code_url.'/'.$value->title_url }}">
                                        @if(strlen($value->title)>40)
                                        {{ mb_substr($value->title,0,20).' ... ' }}
                                        @else
                                        {{ $value->title }}
                                        @endif
                                    </a>
                                </p>
                                <a href="{{ url('product').'/'.$value->code_url.'/'.$value->title_url }}">
                                <p class="product_discounts" @if(!empty($value->discounts) && !empty($value->price))
                                    style="background: #F5F6F7;" @endif>

                                    @if(!empty($value->discounts) && !empty($value->price))
                                    {{ arabic_w2e( number_format($value->price)) }} تومان
                                    @endif

                                </p>


                                <p class="product_price">
                                    @if(!empty($value->discounts) && !empty($value->price))

                                    {{ arabic_w2e( number_format($value->price - $value->discounts)) }}
                                    تومان
                                    @elseif(!empty($value->price))

                                    {{ arabic_w2e( number_format($value->price)) }} تومان
                                    @endif

                                </p>
                                 </a>
                            </div>
                            @endforeach
                        </section>


                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid  ">
    <div class="row">
         
        <div class="col-md-6 text-center ">
                <figure class="banner-two">
                <img class="img-fluid  mbanner  " src="{{url('img/mbanner3.jpg')}}">
                </figure>
            </div>
            <div class="col-md-6 text-center">
                <figure class="banner-two">
                <img class="img-fluid mbanner " src="{{url('img/mbannertwo.jpg')}}">
                </figure>
        </div>
    </div>

</div>


<section>

        <div class="container-fluid indicator ">
            <div class="title order-title  ">
                <h2 class="text-center">محصولات شاخص</h2>
            </div>
            <div class="row">
    
                <div class="col-md-6">
                    @foreach ($mobile_products as $item)
                    @if ($loop->first)
                    <figure>
                        <a href="{{ url('product').'/'.$item->code_url.'/'.$item->title_url }}">
                        <img style="width:100%;max-width:450px" class="img-fluid rounded mx-auto d-block"
                            src="{{ url('upload').'/'.$item->get_img->url }}">
                    </figure>
                </a>
                    <p class="indicator-fa">{{$item->title}}</p>
                    <p class="indicator-en">{{$item->code}}</p>
                    @endif
                    @endforeach
                    <div class="items-product-index d-flex">
                            <div class="col-md-7  p-0">
                                @foreach($items as $key=>$value)
                                <?php
                                    $get_child_item = $value->get_child_item;
                                    ?>
                                @foreach($get_child_item as $key2=>$value2)
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item indicator-li pl-0 text-center mr-4">
                                        <span> {{ $value2->name }} :</span>
                                    </li>
                                </ul>
                                @endforeach
        
        
                                @endforeach
                            </div>
                            <div class="col-md-1 col-xs-2">
        
        
        
        
        
                                <ul class="list-group list-group-flush text-right">
                                    @foreach ($item_value as $item)
                                    @if($item->value==1 )
                                    <li style="color:skyblue; padding:13px" class="list-group-item pr-0 fa fa-check"></li>
                                    @endif
                                    @endforeach
                                </ul>
        
        
                            </div>
                            
                        </div>
                        @foreach ($mobile_products as $item)
                        @if ($loop->first)
                        <a href="{{ url('product').'/'.$item->code_url.'/'.$item->title_url }}" style="color:white" class="btn btn-info-custom hvr-sweep-to-left btn-index">  افزودن به سبد خرید<i class="fa fa-shopping-cart mr-2"></i> </a>  
                        @endif        
                        @endforeach
    
                </div>
                
                <div class="col-md-6">
                    @foreach ($mobile_products as $item)
                    @if ($loop->last)
                    <a href="{{ url('product').'/'.$item->code_url.'/'.$item->title_url }}">
                    <figure>
                        <img style="height:249px;width:100%;max-width:450px" class="  rounded mx-auto d-block"
                            src="{{ url('upload').'/'.$item->get_img->url }}">
                    </figure>
                    </a>
                    <p class="indicator-fa">{{$item->title}}</p>
                    <p class="indicator-en">{{$item->code}}</p>
    
    
    
                    @endif
                    @endforeach
                    <div class="items-product-index d-flex">
                        <div class="col-md-7  p-0">
                            @foreach($items as $key=>$value)
                            <?php
                                $get_child_item = $value->get_child_item;
                                ?>
                            @foreach($get_child_item as $key2=>$value2)
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item indicator-li pl-0 text-center mr-4">
                                    <span> {{ $value2->name }} :</span>
                                </li>
                            </ul>
                            @endforeach
    
    
                            @endforeach
                        </div>
                        <div class="col-md-1 col-xs-1">
    
    
    
    
    
                            <ul class="list-group list-group-flush text-right">
                                @foreach ($item_value as $item)
                                @if($item->value==1)
                                <li style="color:skyblue; padding:13px" class="list-group-item pr-0 fa fa-check"></li>
                                @endif
                                @endforeach
                            </ul>
    
    
                        </div>
                    </div>
                    @foreach ($mobile_products as $item)
                    @if ($loop->first)
                    <a href="{{ url('product').'/'.$item->code_url.'/'.$item->title_url }}" style="color:white" class="btn btn-info-custom hvr-sweep-to-left btn-index">  افزودن به سبد خرید<i class="fa fa-shopping-cart mr-2"></i> </a>  
                    @endif        
                    @endforeach
                </div>
                
            </div>
        </div>
    </section>
<div class="container-fluid">
    <figure style="overflow:hidden; border-radius:17px;box-shadow: 0 0 22px -5px #A2C8F9;">
    <img  class="w-100 middle-banner" src="{{url('img/banner-middleV2.jpg')}}">
        </figure>
</div>
    <section id="news">


        <div class="container-fluid news-section ">
    
            <div class="title order-title  ">
                <h2 class="text-center">آخرین اخبار سایت</h2>
            </div>
            <div class="p-3">
                <div class="row">
                    @foreach ($news_all as $item)
                    <div class="col-md-3">
                        <div class="all-news">
                            <div class="img-news position-relative">
                                <span class="date-news"> {{arabic_w2e(jdate($item->created_at)->format('%A, %d %B %y'))}}
                                </span>
                                <figure class="shin">
                                    <a href="{{ route('news.single' , ['news' => $item->id ]) }}">
                                        <img width="100%" src="{{$item->images['images']['300']}}">
                                    </a>
                                </figure>
    
                            </div>
                            <div class="panel-content">
                                <a class="news-title"
                                    href="{{ route('news.single' , ['news' => $item->id ]) }}">{{str_limit($item->title,54)}}</a>
                                <a href="{{ route('news.single' , ['news' => $item->id ]) }}"
                                    class="btn btn-info btn-sm btn-sm-custom mr-2" role="button">ادامه خبر</a>
                            </div>
                            <div class="p-details">
                                <i class="fa fa-eye"></i>
                                <span class="mr-1">{{arabic_w2e($item->viewCount)}}</span>
                                <i style="position:absolute;left:20px; color:skyblue" class="fa fa-user pull-left">-ادمین</i>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
     
                </div>
            </div>
        </div>
    
    
    
    
    </section>
    
<section id="we-are">
    <div class="container-fluid">
        <h1 class="text-center">گروه<span class="yellow"> هیراد</span> کویر</h1>
        <button  style="position: relative;top: -66px;left: 10px;" class=" mobile-team btn  btn-outline-info" id="show_team">مشاهده
            اعضا گروه هیراد</button>
        <div class="w-100 our-team" id="show_ourteam">
            <div class="title-section1 d-table mx-auto w-100 mb-3">
                <h1 style=" " class="text-center">تــیــم هیراد کویر</h1>

                <div class="team-line center-block"></div>
                <h4 style=" " class="text-center">گروه هیراد کویر ارائه دهنده خدمات نوین با کادری مجرب و متعهد</h4>
            </div>
            <div class="row">

                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail thumbnail-custom">
                        <img width="150" height="150"
                            class="img-responsive img-rounded rounded-circle d-table mx-auto lazy"
                            src="/img/team/hesani.jpg">
                        <div class="caption caption-custom text-center">
                            <h5>امین حسانی فر </h5>
                            <h6>دارای مدرک مهندسی فناوری اطلاعات و فعال در بخش بازاریابی شرکت </h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail thumbnail-custom">
                        <img width="150" height="150"
                            class="img-responsive img-rounded rounded-circle d-table mx-auto lazy"
                            src="/img/team/hessanifar.jpg">
                        <div class="caption caption-custom text-center">
                            <h5>محمد رضا حسانی فر</h5>
                            <h6>دارای مدرک کارشناسی برق, 15 سال سابقه فعالیت مستمر در زمینه خودرو </h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail thumbnail-custom">
                        <img width="150" height="150"
                            class="img-responsive img-rounded rounded-circle d-table mx-auto lazy"
                            src="/img/team/seyed_ali.jpg">
                        <div class="caption caption-custom text-center">
                            <h5>سید علی بهشت آئین</h5>
                            <h6>دارای مدرک مهندسی برق و متخصص در مونتاژ سخت افزار</h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail thumbnail-custom">
                        <img width="150" height="150"
                            class="img-responsive img-rounded rounded-circle d-table mx-auto lazy "
                            src="/img/team/salari.PNG">
                        <div class="caption caption-custom text-center">
                            <h5>سید محمد سالاری </h5>
                            <h6>دارای مدرک فناوری اطلاعات و برنامه نویس اندروید </h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail thumbnail-custom">
                        <img width="150" height="150"
                            class="img-responsive img-rounded rounded-circle d-table mx-auto lazy"
                            src="/img/team/mohammad_hassan.jpg">
                        <div class="caption caption-custom text-center">
                            <h5>محمد حسن قاسمی نژاد</h5>
                            <h6> دارای مدرک مهندسی تکنولوژی الکترونیک </h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail thumbnail-custom ">
                        <img width="150" height="150" class="  img-rounded rounded-circle d-table mx-auto lazy "
                            src="/img/team/mohammad_hossen.jpg">
                        <div class="caption caption-custom text-center">
                            <h5>محمد حسین قاسمی نژاد</h5>
                            <h6>دارای مدرک فیزیک جامدات </h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail thumbnail-custom ">
                        <img width="150" height="150" class="  img-rounded rounded-circle d-table mx-auto lazy "
                            src="/img/team/mohammad_hossen.jpg">
                        <div class="caption caption-custom text-center">
                            <h5>محمد حسین قاسمی نژاد</h5>
                            <h6>دارای مدرک فیزیک جامدات </h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail thumbnail-custom ">
                        <img width="150" height="150" class="  img-rounded rounded-circle d-table mx-auto lazy "
                            src="{{url('/img/team/mohammad_hossen.jpg')}}">
                        <div class="caption caption-custom text-center">
                            <h5>محمد حسین قاسمی نژاد</h5>
                            <h6>دارای مدرک فیزیک جامدات </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-4 ">

                <img class="imgres img-weare" src="{{URL::asset('/img/smart-workplace-100539537-primary.idge.jpg')}}"
                     width="485" height="377">

            </div>

            <div class="col-md-8">
                <h2 class="custom-text-weare">
                    طراحی نسل جدید سیستمهای چند رسانه ایی خودرو برپایة سیستم عامل اندروید. در ابتدا با آپشن های
                    موجود در
                    بازار، تست کردن و رفع عیوب محصول، بعدازآن شروع به تولید و عرضه در بازار میشود.به طور همزمان
                    تحقیق و
                    توسعه شرکت درجهت ارتقاء محصول و آپشن های اختصاصی گام برداشته شود.محصولات ارائه شده در بازارایران
                    کمتر درزمینه اندروید بوده درصورتی که علاقه مردم به سیستم های اندروید به دلیل راحتی کاربا آن و
                    ارتقاء
                    دادن آن و همچنین طیف گسترده تر نرم افزارها و ارتباط برقرارکردن با اینترنت بیشتر می باشد.
                </h2>


                <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
                <div class="wrapper">
                    <div class="container">
                        <h1 class="text-center">فرم تماس با ما</h1>
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label  class="pull-right" for="inputEmail4">ایمیل</label>
                                    <input type="email" class="form-control" id="inputEmail4">


                                </div>
                                <div class="form-group col-md-6">
                                    <label class="pull-right"   for="inputname">نام و نام خانوداگی</label>
                                    <input type="text" class="form-control" id="inputname">
                                 </div>
                            </div>


                            <div class="form-group">
                                <label class="pull-right">متن پیام</label>
                                <textarea class="form-control" rows="8"></textarea>


                            </div>
                            <button type="button" class="btn btn-block btn-metrial">ارسال</button>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>

@endsection


 @section('script')
 <script>
    var amazing_time = [];
    var i = 0;

    <?php



    foreach($amazing as $key => $value) {
            $time = ($value->timestamp - time() > 0) ? $value->timestamp - time() : 0;
            ?>
            amazing_time[i] = <?= $time ?> ;
            i++; <?php


        }

        ?>


</script>

<script>
    $('.amazing_product').slick({
    infinite: false,
    speed: 900,
    slidesToShow:1.4,
    slidesToScroll: 1.3,
    rtl:true,
    responsive: [
        {
            breakpoint:290,
            settings: {
                slidesToShow: 1,
                slidesToScroll:1,
                infinite: false
            }
        },
        {
            breakpoint:400,
            settings: {
                slidesToShow: 1.4,
                slidesToScroll:1.3,
                infinite: false
            }
        },
        {
            breakpoint:600,
            settings: {
                slidesToShow: 2.7,
                slidesToScroll:2.7,
                infinite: false
            }
        }
    ]
});

</script>
<script>
    $('.new_product').slick({
        infinite: false,
        dots: true,
        speed: 1000,
        slidesToShow: 4,
        slidesToScroll: 4,
        rtl: true,
        responsive: [{
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
                breakpoint: 450,
                settings: {
                    slidesToShow: 2.5,
                    slidesToScroll: 2.5
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
<script>
    function checkValue(element) {
        // check if the input has any value (if we've typed into it)
        if ($(element).val())
            $(element).addClass('has-value');
        else
            $(element).removeClass('has-value');
    }

    $(document).ready(function () {
        // Run on page load
        $('.form-control').each(function () {
            checkValue(this);
        });
        // Run on input exit
        $('.form-control').blur(function () {
            checkValue(this);
        });

    });

</script>


 @endsection
