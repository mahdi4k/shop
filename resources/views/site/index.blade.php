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
</div>    
@include('site.index-sections.new-product-section')


<div class="container-fluid">
    <figure style="overflow:hidden; border-radius:17px;box-shadow: 0 0 22px -5px #A2C8F9;">
    <img  class="w-100 middle-banner" src="{{url('img/banner-middleV2.jpg')}}">
        </figure>
</div>


@include('site.index-sections.indicator-product-section')


@include('site.index-sections.news_section')



@include('site.index-sections.we-are-section')
 
@endsection
@section('footer_site')
<script src="{{url('js/slick.js')}}"></script>
<script src="{{url('js/flipclock.min.js')}}"></script>
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