@extends('site.master')
@section('title')
    ثبت سفارش | هوشمند سازان خودرو
@endsection
@section('style')
    <link href="{{ url('css/bootstrap-select.css') }}" rel="stylesheet">

@endsection

@section('content')

    <div class="container-fluid">
        <div class="row content_box">


            <div class="header_order">

                <div style="padding-top:40px">


                    <div class="first_div_order_header d-flex justify-content-center">

                        <div class="clearfix">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>

                        <span class="bullet login green tick">
                        <a>
                            <span>ورود به سایت</span>
                        </a>
                    </span>

                        <div class="rounded_rectangle_over step_shipping"></div>


                        <span class="bullet login green">
                        <a>

                            <span>   اطلاعات ارسال سفارش</span>
                        </a>
                    </span>


                        <div class="rounded_rectangle_over step_shipping line_order"></div>

                        <span class="bullet login">
                        <a>
                            <span>اطلاعات پرداخت</span>
                        </a>
                    </span>


                    </div>


                </div>

            </div>


            <form class="w-100" action="{{ url('review') }}" method="post">
                {{ csrf_field() }}
                <div style="width:95%;margin:50px auto; text-align: right">

                    <p><span class="icon_item_name"></span><span style="padding-right:5px;">انتخاب آدرس </span>

                        <a class="btn btn-danger" onclick="show_address_form()">افزودن آدرس جدید</a>
                    </p>


                    <input type="hidden" name="order_type" id="order_type" value="1">

                    @foreach($address as $key=>$value)

                        @if($key==0)
                            <input type="hidden" name="order_address" value="{{ $value->id }}" id="order_address">

                        @endif
                        <table id="address_table_<?= $value->id ?>"
                               class=" user_address @if($key==0) active_address @endif">

                            <tr>
                                <td class="first_td" rowspan="3">


                                    <div style="width:100%;position:absolute;top:-1px;right:0px">
                                   <span id="span_action_<?= $value->id ?>"
                                         class="@if($key==0) active-address @else span_address @endif">
                                   <li class="icon-shopping-white-mark"></li>
                                   </span>
                                    </div>

                                    <div id="address_radio_<?= $value->id ?>"
                                         class="@if($key==0) radio-control2 @else radio-control @endif"
                                         onclick="set_addrees('<?= $value->id ?>')">
                                        <label></label>
                                    </div>
                                </td>
                                <td colspan="3">
                                    <span>گیرنده :</span> {{ $value->name }}
                                </td>

                                <td class="end_td" rowspan="3">
                                    <div class="edit_address" onclick="edit_address('<?= $value->id ?>')">
                                        <span class="fa fa-edit"></span>
                                    </div>
                                    <div class="delete_address">
                                        <span class="fa fa-remove"
                                              onclick="del_row('<?= $value->id ?>','<?= url('remove_address') ?>','<?= Session::token() ?>')"></span>
                                    </div>
                                </td>

                            </tr>

                            <tr>

                                <td>
                                    <span>استان   </span>
                                    <span>
                               {{ $value->get_ostan->ostan_name }}
                                        ,
                                    </span>
                                    <span>شهر
                                        {{ $value->get_shahr->shahr_name }}
                                        {{ $value->address }}
                                    </span>
                                </td>


                            </tr>
                            <tr>


                                <td>
                                    <span>شماره تماس اضطراری : </span>
                                    <span>{{ $value->mobile }}</span>
                                    <span>شماره تماس ثابت : </span>
                                    <span>{{ $value->tell.' - '.$value->tell_code }}</span>
                                </td>
                            </tr>


                        </table>
                    @endforeach


                    <p style="padding-top:30px"><span class="icon_item_name"></span><span style="padding-right:5px;">انتخاب شیوه ارسال </span>
                    </p>





                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 d-flex justify-content-around">
                                <div class="card border-primary mb-3" style="max-width: 21rem;">
                                    <div class="card-header text-center bg-transparent border-primary">تحويل اکسپرس
                                        هوشمند خودرو
                                    </div>
                                    <div class="card-body">
                                        <div style="margin: 5px auto 5px auto" class="d-flex justify-content-center">
                                            <img src="{{ url('img/post_48_icon.png') }}">
                                        </div>
                                        <p class="card-text">زمان تحويل: 1 روز کاري درصورت ثبت سفارش تا ساعت 12</p>
                                    </div>
                                    <div class="w-100 d-flex justify-content-center mb-2">
                                        <button id="addcheck" type="button" style="border-radius: 6px;padding: 8px;"
                                                class="  btn   btn-primary  "><span> انتخاب روش ارسال</span></button>
                                    </div>
                                    <div class="card-footer text-center bg-transparent border-primary">هزینه ارسال 10000 هزار
                                        تومان
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-around">
                                <div class="card border-primary mb-3" style="width: 21rem;">
                                    <div class="card-header text-center bg-transparent border-primary">باربري (پس کرايه
                                        | لوازم خانگي سنگين)
                                    </div>
                                    <div class="card-body    ">
                                        <div style="margin: 5px auto 5px auto" class="d-flex justify-content-center">
                                            <img src="{{ url('img/post_48_icon.png') }}">
                                        </div>
                                        <p class="card-text"> ويژه لوازم خانگي سنگين</p>
                                    </div>
                                    <div class="w-100 d-flex justify-content-center mb-2">
                                        <button id="addcheck1" type="button" style="border-radius: 6px;padding: 8px;"
                                                class="btn btn-sm btn-primary  "><span>انتخاب روش ارسال</span></button>
                                    </div>
                                    <div class="card-footer text-center bg-transparent border-primary">هزینه ارسال پس کرایه</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="float: left;margin-top:40px;margin-bottom:30px">

                        <a href="{{url('Payment')}}" class="btn btn-info-custom-payment hvr-sweep-to-left">ثبت اطلاعات و
                            ادامه خرید</a>

                    </div>

                </div>
            </form>
        </div>

    </div>

    @include('site.include.new_address',['ostan'=>$ostan])



    <div class="modal fade" id="edit_address" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h5 style="position: relative;left: 355px;" class="modal-title" id="myModalLabel">ویرایش آدرس</h5>
                </div>
                <div id="loading_box">
                    <div class="loading"></div>
                    <span>در حال دریافت اطلاعات</span>
                </div>
                <div class="modal-body" id="edit_address_form">


                </div>

            </div>
        </div>
    </div>

@endsection

@section('footer_site')
    <?php
    $url = url('shop/get_ajax_shahr');
    $url2 = url('shop/add_address');
    $url3 = url('Shipping');
    $url4 = url('shop/edit_address_form');
    ?>
    <script type="text/javascript" src="{{ url('js/bootstrap-select.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/defaults-fa_IR.js') }}"></script>
    <script>

        show_address_form = function () {
            $("#new_address").modal('show');
        };

        get_shahr = function (ostan_id, shahr_id) {
            var ostan_id = document.getElementById(ostan_id).value;
            $.ajaxSetup(
                {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                url: '{{ $url }}',
                type: 'POST',
                data: 'ostan_id=' + ostan_id,
                success: function (data) {
                    var shahr = $.parseJSON(data);
                    var html = '';
                    for (var i = 0; i < shahr.length; i++) {
                        html += '<option value=' + shahr[i].id + '>' + shahr[i].shahr_name + '</option>';
                    }
                    if (html.trim() != '') {
                        $("#" + shahr_id).html(html).selectpicker('refresh');
                    }
                    else {
                        html = '<option value="">انتخاب شهر</option>';
                        $("#" + shahr_id).html(html);
                    }
                }
            });
        };
        <?php

        if(sizeof($errors->all()) > 0)
        {
        ?>
        $("#new_address").modal('show');
        <?php
            }
            ?>
            add_address = function () {
            $.ajaxSetup(
                {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            var data = $("#address_form").serialize();
            $.ajax({
                url: '{{ $url2 }}',
                type: 'POST',
                data: 'data=' + data,
                success: function (data) {

                    if (data == 'ok') {
                        window.location = '<?= $url3 ?>';
                    }
                    else if (data == 'error') {
                        alert('خطا در ثبت اطلاعات-مجددا تلاش کنید')
                    }
                    else {
                        var d = $.parseJSON(data);
                        var string = 'name|ostan_id|shahr_id|tell|tell_code|mobile|zip_code|address';
                        var e = string.split('|');
                        for (var i = 0; i < e.length; i++) {
                            $("#error_" + e[i]).html("");
                        }
                        $.each(d, function (key, value) {
                            $("#error_" + key).html(value);
                        });
                    }
                }
            });
        };
        edit_address = function (id) {
            $("#edit_address").modal('show');
            $("#edit_address_form").html("");
            $("#loading_box").show();
            $.ajaxSetup(
                {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                url: '{{ $url4 }}',
                type: 'POST',
                data: 'address_id=' + id,
                success: function (data) {
                    if (data == 'error') {
                        $("#loading_box").hide();
                        $("#edit_address").modal('hide');

                    }
                    else {
                        $("#loading_box").hide();
                        $("#edit_address_form").html(data);
                        $("#edit_shahr_list").selectpicker();
                        $("#edit_ostan_id").selectpicker();
                    }
                },
                error: function () {
                    window.location = '<?= url('403') ?>';
                }
            });
        };
        edit_user_address = function (id) {
            $.ajaxSetup(
                {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            var data = $("#address_form_" + id).serialize();
            var url = $("#address_form_" + id).attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                data: 'data=' + data,

                success: function (data) {

                    if (data == 'ok') {
                        window.location = '<?= $url3 ?>';
                    }
                    else if (data == 'error') {
                        alert('خطا در ثبت اطلاعات-مجددا تلاش کنید');
                    }
                    else {
                        var d = $.parseJSON(data);
                        var string = 'edit_name|edit_ostan_id|edit_shahr_id|edit_tell|edit_tell_code|edit_mobile|edit_zip_code|edit_address';
                        var e = string.split('|');
                        for (var i = 0; i < e.length; i++) {
                            $("#error_edit_" + e[i]).html("");
                        }
                        $.each(d, function (key, value) {
                            $("#error_edit_" + key).html(value);
                        });
                    }
                }
            });
        };
        set_addrees = function (id) {
            document.getElementById('order_address').value = id;
            var c = document.getElementsByClassName('radio-control2');
            for (var i = 0; i < c.length; i++) {
                c[i].className = 'radio-control';
            }
            var c2 = document.getElementsByClassName('active-address');
            for (var j = 0; j < c2.length; j++) {
                c2[j].className = 'span_address';
            }
            document.getElementById('address_radio_' + id).className = 'radio-control2';
            document.getElementById('span_action_' + id).className = 'active-address';
            $(".user_address").removeClass('active_address');
            $("#address_table_" + id).addClass('active_address');
        };
        set_type = function (id) {
            document.getElementById('order_type').value = id;

            var c = document.getElementsByClassName('type-radio-control2');

            for (var i = 0; i < c.length; i++) {
                c[i].className = 'type-radio-control';

            }
            document.getElementById('type_radio_' + id).className = 'type-radio-control2';
        };

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
            })
            // Run on input exit
            $('.form-control').blur(function () {
                checkValue(this);
            });

        });
    </script>
@endsection
