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
?>
<div class="breadcrumb-news d-flex justify-content-center">
        <ul class="list-inline mb-0">
            <li style="border-bottom: 1px dashed skyblue;" class="list-inline-item">
                <i style="color:skyblue;" class="fa fa-home"></i>
            <a href="{{url('/')}}">
                هوشمند خودرو
            </a>
            </li>
            <li style="font-size: 13px; margin-right: 9px;position:relative;border-bottom: 1px dashed skyblue;" class="list-inline caret-left-news">
            <a href="{{url('/#news')}}">
            اخبار
            </a>

            </li>
            <li style="font-size: 11px;
            position: relative;
            margin-right: 9px;" class="list-inline-item caret-left">
          
                    <p >{{str_limit($all_news->title,20)}}</p>
            </li>
        </ul>
    </div>
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