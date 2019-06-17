@extends('mobile.layout')
@section('content')
<div class="container-fluid w-98">
    <div class="row" id="filter_product_box">




        <div class="col-md-9 show_product">


            <div style="width:97%;margin:auto">
                <div style="width:97%;float:right">


                </div>
            </div>




            <div style="padding-top: 15px;width: 100%;background: white;border-radius: 13px;">
                <span style="ppadding-right: 15px;text-align: center;width: 100%;display: block;">مرتب سازی بر اساس :
                </span>
                <ul class="search_type_ul">
                    <li id="search_type_1" class="active" onclick="set_type(1)">جدیدترین</li>
                    <li id="search_type_2" onclick="set_type(2)">پربازدیدترین</li>
                    <li id="search_type_3" onclick="set_type(3)">پرفروش ترین</li>
                    <li id="search_type_4" onclick="set_type(4)">ارزانترین</li>
                    <li id="search_type_5" onclick="set_type(5)">گرانترین</li>
                     
                </ul>
            </div>
            <div class="text-center mt-2">
                    <span>تعداد نتایج :</span> <span> {{ sizeof($product) }}</span> <span>محصول</span>
            </div>

            <div id="show_product" style="width:100%;float:right">
                @include('site.include.product_list2',['product'=>$product,'cat_url'=>'','Search_text'=>$Search_text])

            </div>

        </div>
        <div class="col-md-3">

            <div class="filter_box">


                <div style="clear:both"></div>
                <div
                    style="background:white;border-bottom: 1px solid #E3E3E3;padding:30px 15px 20px 15px;cursor:pointer">
                    <p onclick="set_status_product()">

                        <span id="status_prodict_ic" class="filter_checkbox"></span>
                        <input id="status_product" type="checkbox" class="search_checkbox">

                        <span>نمایش محصولات موجود</span>
                    </p>
                </div>


                <ul class="cat_ul">
                    <ul>
                        @foreach($category as $key=>$value)
                        <li>
                            <span class="fa fa-angle-left"></span>
                            <a href="{{ url('category').'/'.$value->cat_ename }}">{{ $value->cat_name }}</a></li>
                        @endforeach
                    </ul>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')
<?php
$url=url('Search').'?text=';
?>
<script>
    var product_status=0;
    var product_type=1;
    var Search_text='<?= $Search_text ?>';
    search_product=function ()
    {
        var text=document.getElementById('search_input').value;
        if(text.trim()!='')
        {
            Search_text=text;
            var search_url='<?= $url ?>'+Search_text;
            send_data(search_url);
        }
    };
    send_data=function (url) {
        $.ajax({
            url:url,
            type:"GET",
            data:'product_status='+product_status+'&type='+product_type,
            success:function (data)
            {
                $("#show_product").html(data);
            }
        });
    };

    $('.pagination a').click(function (event) {
        event.preventDefault();
        var url=$(this).attr('href');
        var url=url.split('page=');
        if(url.length==2)
        {
            var  search_url='<?= $url ?>'+Search_text;
            var ajax_url=search_url+'&page='+url[1];
            send_data(ajax_url);
        }
    });


    set_type=function (type)
    {
        product_type=type;
        $('.search_type_ul li').removeClass('active');
        $("#search_type_"+type).addClass('active');
        var search_url='<?= $url ?>'+Search_text;
        send_data(search_url);
    };

    set_status_product=function ()
    {
        var c=document.getElementById('status_product');
        if(c)
        {
            if(c.checked)
            {
                product_status=0;
                c.checked=false;
                $("#status_prodict_ic").removeClass('filter_checkbox2');
                $("#status_prodict_ic").addClass('filter_checkbox');
            }
            else
            {
                product_status=1;
                c.checked=true;
                $("#status_prodict_ic").removeClass('filter_checkbox');
                $("#status_prodict_ic").addClass('filter_checkbox2');
            }
        }
        var search_url='<?= $url ?>'+Search_text;
        send_data(search_url);
    };

</script>
@endsection