@extends('site.master')
@section('style')
<link rel="stylesheet" href="{{url('css/flipTimer.css')}}">
@endsection
@section('title')
هوشمندسازان خودرو | هیراد کویر
@endsection

@section('content')
<?php
    function arabic_w2e($str)
    {
        $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return str_replace($arabic_western, $arabic_eastern, $str);
    }

      $i=1; $Jdf=new \App\lib\Jdf();
    ?>





<div class="clearfix"></div>
@include('site.index-sections/slider-section')


<div class="clearfix"></div>

@include('site.index-sections.about-section') 

@include('site.index-sections.amazing-section')
 
<div   class="container-fluid  ">
    <div class="row">
        <div class="img-cover ">
             
            <div class="col-md-6 text-center">
                <img class="img-fluid" src="{{url('img/1000004013.jpg')}}">
            </div>
            <div class="col-md-6 text-center">
                <img class="img-fluid" src="{{url('img/1000003909.jpg')}}">

            </div>
        </div>
    </div>
</div>    
@include('site.index-sections.new-product-section')


<div>
    <img class="w-100" src="{{url('img/banner.jpg')}}">
</div>


@include('site.index-sections.indicator-product-section')


@include('site.index-sections.news_section')



@include('site.index-sections.we-are-section')
 
@endsection
@section('footer_site')
<script>
    var amazing_time=new Array;
    var i=0;

<?php

    foreach ($amazing as $key=>$value)
    {
        $time=($value->timestamp-time()>0) ? $value->timestamp-time(): 0;
        ?>
      amazing_time[i]=<?= $time ?>;
        i++;
<?php
    }

 ?>
</script>
 
<script type="text/javascript" src="{{ url('js/flipclock.min.js') }}"></script>
 

<script>
    $('.amazing').slick({
        rtl: true,
        speed: 900,
        slidesToShow: 3,
        slidesToScroll: 2,
        variableWidth: true,
        infinite: false
    });

</script>
<script>
                var sliderTag = $('#slider');
                var sliderItems = sliderTag.find('.item');
            
                var numItems = sliderItems.length;
                var nextSlide = 1;
                var timeout = 50000;
                var slidernavigator = sliderTag.find("#slider_navigator ul li");
            
                function slider() {
                    if (nextSlide > numItems) {
                        nextSlide = 1;
                    }
                    if (nextSlide < 1) {
                        nextSlide = numItems;
                    }
                    sliderItems.fadeOut(0);
                    sliderItems.eq(nextSlide - 1).fadeIn(100);
                    slidernavigator.removeClass('active');
                    slidernavigator.eq(nextSlide - 1).addClass('active');
                    nextSlide++;
            
            
                }
                slider();
                var sliderinterval = setInterval(slider, timeout);
                sliderTag.mouseleave(function () {
                    clearInterval((sliderinterval));
                    sliderinterval = setInterval(slider, timeout);
                });
            
            
                function gotonext() {
                    slider();
                }
            
                $(' #slider').find('#next').click(function () {
                    clearInterval(sliderinterval);
                    gotonext();
            
            
                });
            
                function gotoprev() {
                    nextSlide = nextSlide - 2;
                    slider();
                }
            
                $(' #slider  ').find('#prev').click(function () {
                    clearInterval(sliderinterval);
                    gotoprev()
            
                });
            
                function gotoslide(index) {
                    nextSlide = index;
                    slider();
            
                }
            
                $('#slider').find('#slider_navigator li ').click(function () {
                    clearInterval(sliderinterval);
            
                    var index = $(this).index();
                    gotoslide(index + 1);
            
            
                });


    var sliderTag2 = $('#slider2');
    var sliderItems2 = sliderTag2.find('.item');

    var numItems2 = sliderItems2.length;
    var nextSlide2 = 1;
    var timeout2 = 5000;
    var slidernavigator2 = sliderTag2.find("#slider2_navigator ul li");

    function slider2() {
        if (nextSlide2 > numItems2) {
            nextSlide2 = 1;
        }
        if (nextSlide2 < 1) {
            nextSlide2 = numItems2;
        }
        sliderItems2.fadeOut(0);
        sliderItems2.eq(nextSlide2 - 1).fadeIn(100);
        slidernavigator2.removeClass('active');
        slidernavigator2.eq(nextSlide2 - 1).addClass('active');
        nextSlide2++;


    }
    slider2();
    var sliderinterval2 = setInterval(slider2, timeout);
    sliderTag.mouseleave(function () {
        clearInterval((sliderinterval2));
        sliderinterval2 = setInterval(slider2, timeout2);
    });


    function gotonext2() {
        slider2();
    }


    function gotoslide2(index) {
        nextSlide2 = index;
        slider2();

    }

    $('#slider2').find('#slider2_navigator li ').click(function () {
            clearInterval(sliderinterval2);

            var index = $(this).index();
            gotoslide2(index + 1);


        }
    );

    //    end slider2

    //    timer

    
</script>
<script>
    $('.new_product').slick({
        infinite: true,
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
<script>
    $(document).ready(function () {
            $('#ajaxSubmit').click(function (e) {
                e.preventDefault();
                $.ajaxSetup(
                        {
                            'headers': {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                jQuery.ajax({
                    url: "{{ url('/getData') }}",
                    method: 'post',
                    data: {
                        name: jQuery('#name').val(),
                        email: jQuery('#email').val(),
                        text: jQuery('#text').val()
                    },
                        success:function(data){
                            //console.log(data);
                            $('#success_message').fadeIn().html(data.message).fadeOut(6000);
                        },
                        error: function (err) {
                            if (err.status == 500) { // when status code is 422, it's a validation issue
                                console.log(err.responseJSON);
                                $('#error_message').fadeIn(300).delay(4000).fadeOut(300) ;

                                // you can loop through the errors object and show it to the user
                                console.warn(err.responseJSON.errors);
                                // display errors on each form field
                                $.each(err.responseJSON.errors, function (i, error) {
                                    var el = $(document).find('[name="' + i + '"]');
                                    el.after($('<span style="color: red;">' + error[0] + '</span>'));
                                });
                            }
                        }

                }
                );
            });
        });
</script>

@endsection