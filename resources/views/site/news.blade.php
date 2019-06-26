@extends('site.master')

@section('title')
مشخصات، قیمت و خرید {{$all_news->title}}
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
 
<div class="container news-section-single ">
    <div class="row">
        <div class="col-md-12">

                <div class="img-news position-relative">
                <span class="date-news-single"> {{arabic_w2e(jdate($all_news->created_at)->format('%A, %d %B %y'))}} </span>
                <div class="single-title-news">
                        <p class="text-right titer-news">{{$all_news->title}}</p>
                    </div>
                <figure class="shin">
                    
                        <img style="border-radius:5px" width="100%" src="{{$all_news->images['images']['original']}}">
                     
                </figure>
                
            </div>
            
            <div class="news-single-body">
            <p>{!! $all_news->description  !!}</p>
            </div>

        </div>
    </div>
</div>

@endsection