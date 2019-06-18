@extends('mobile.layouts.user')
@section('panel_content')


@foreach($address as $key=>$value)
@if($key==0)
<input type="hidden" name="order_address" value="{{ $value->id }}" id="order_address">
@endif
<div id="address_radio_<?= $value->id ?>" class="@if($key==0) radio-control2 @else radio-control @endif"
    onclick="set_addrees('<?= $value->id ?>')">
    <button class="btn btn-light">
        <span style="cursor: pointer;">انتخاب این آدرس برای ارسال</span>
        <em></em>
    </button>
</div>
<div class="d-flex justify-content-center">
    <i style="color: #ccc;font-size: 37px;" class="fa fa-angle-double-down" aria-hidden="true"></i>
</div>
<div id="address_table_<?= $value->id ?>" class="  user_address @if($key==0) active_address @endif">

    <div class="d-flex">
        <span id="span_action_<?= $value->id ?>" class="@if($key==0) active-address @else span_address @endif">
            <li class="icon-shopping-white-mark"></li>
        </span>
    </div>



    <div class="girande-address">
        <span class="ml-2" style="color: #9e8585;font-size: 19px;"><i class="fa fa-address-card"></i> </span>
        <span style="font-size: 18px;color: #7b7575; ">گیرنده :</span>
        <span style="color:#5f5454">{{ $value->name }}</span>
    </div>



    <div class="ostan-address">
        <div class="row">
                <div class="com-xs-1">
                        <span class="ml-3" style="color: #9e8585;font-size: 19px;"><i style="position: relative;right: 18px;top: 1px" class="fa fa-map-marker"></i></span>
                </div>
                <div class="col-xs-10">
                        <span style="font-size: 18px;color: #7b7575;">آدرس :</span>
                        <span style="color:#5f5454">استان </span>
                        <span style="color:#5f5454">
                            {{ $value->get_ostan->ostan_name }}
                            ,
                        </span>
                        <span style="color:#5f5454">شهر
                            {{ $value->get_shahr->shahr_name }}
                            {{ $value->address }}
                        </span>
                </div>
        </div>
        
        
        
    </div>





    <div class="callNumber-adress">
        <div class="row">
            <div class="col-xs-1">


                <span class="ml-3" style="color: #9e8585;font-size: 19px;"><i class="fa fa-phone"
                        aria-hidden="true"></i></span>
            </div>
            <div class="col-xs-10">
                <span>شماره تماس اضطراری : </span>
                <span>{{ $value->mobile }}</span>
                <span>شماره تماس ثابت : </span>
                <span>{{ $value->tell.' - '.$value->tell_code }}</span>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="btn btn-outline-light edit_address" onclick="edit_address('<?= $value->id ?>')">
        <span class="fa fa-edit"></span>
        <span>ویرایش آدرس</span>
    </div>
    <div class="btn btn-outline-light delete_address">
        <span class="fa fa-remove"
            onclick="del_row('<?= $value->id ?>','<?= url('remove_address') ?>','<?= Session::token() ?>')">
            <span>حذف آدرس</span>
        </span>
    </div>
</div>

@endforeach
<a class="btn btn-danger" onclick="show_address_form()">افزودن آدرس جدید</a>
@include('site.include.new_address',['ostan'=>$ostan])
<div class="modal fade" id="edit_address" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close position-absolute" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h5 class="modal-title w-100" id="myModalLabel">ویرایش آدرس</h5>
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
@section('script')
<?php
$url = url('shop/get_ajax_shahr');
$url2 = url('shop/add_address');
$url3 = url('user/editAddress');
$url4 = url('shop/edit_address_form');
?>
<script type="text/javascript" src="{{ url('js/bootstrap-select.js') }}"></script>
<script type="text/javascript" src="{{ url('js/defaults-fa_IR.js') }}"></script>
<script>
    show_address_form = function() {
        $("#new_address").modal('show');
    };

    get_shahr = function(ostan_id, shahr_id) {
        var ostan_id = document.getElementById(ostan_id).value;
        $.ajaxSetup({
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{ $url }}',
            type: 'POST',
            data: 'ostan_id=' + ostan_id,
            success: function(data) {
                var shahr = $.parseJSON(data);
                var html = '';
                for (var i = 0; i < shahr.length; i++) {
                    html += '<option value=' + shahr[i].id + '>' + shahr[i].shahr_name + '</option>';
                }
                if (html.trim() != '') {
                    $("#" + shahr_id).html(html).selectpicker('refresh');
                } else {
                    html = '<option value="">انتخاب شهر</option>';
                    $("#" + shahr_id).html(html);
                }
            }
        });
    };
    <?php

    if (sizeof($errors->all()) > 0) {
        ?>
        $("#new_address").modal('show');
    <?php
}
?>
    add_address = function() {
        $.ajaxSetup({
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var data = $("#address_form").serialize();
        $.ajax({
            url: '{{ $url2 }}',
            type: 'POST',
            data: 'data=' + data,
            success: function(data) {

                if (data == 'ok') {
                    window.location = '<?= $url3 ?>';
                } else if (data == 'error') {
                    alert('خطا در ثبت اطلاعات-مجددا تلاش کنید')
                } else {
                    var d = $.parseJSON(data);
                    var string = 'name|ostan_id|shahr_id|tell|tell_code|mobile|zip_code|address';
                    var e = string.split('|');
                    for (var i = 0; i < e.length; i++) {
                        $("#error_" + e[i]).html("");
                    }
                    $.each(d, function(key, value) {
                        $("#error_" + key).html(value);
                    });
                }
            }
        });
    };
    edit_address = function(id) {
        $("#edit_address").modal('show');
        $("#edit_address_form").html("");
        $("#loading_box").show();
        $.ajaxSetup({
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{ $url4 }}',
            type: 'POST',
            data: 'address_id=' + id,
            success: function(data) {
                if (data == 'error') {
                    $("#loading_box").hide();
                    $("#edit_address").modal('hide');

                } else {
                    $("#loading_box").hide();
                    $("#edit_address_form").html(data);
                    $("#edit_shahr_list").selectpicker();
                    $("#edit_ostan_id").selectpicker();
                }
            },
            error: function() {
                window.location = '<?= url('403') ?>';
            }
        });
    };
    edit_user_address = function(id) {
        $.ajaxSetup({
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

            success: function(data) {

                if (data == 'ok') {
                    window.location = '<?= $url3 ?>';
                } else if (data == 'error') {
                    alert('خطا در ثبت اطلاعات-مجددا تلاش کنید');
                } else {
                    var d = $.parseJSON(data);
                    var string = 'edit_name|edit_ostan_id|edit_shahr_id|edit_tell|edit_tell_code|edit_mobile|edit_zip_code|edit_address';
                    var e = string.split('|');
                    for (var i = 0; i < e.length; i++) {
                        $("#error_edit_" + e[i]).html("");
                    }
                    $.each(d, function(key, value) {
                        $("#error_edit_" + key).html(value);
                    });
                }
            }
        });
    };
    set_addrees = function(id) {
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
    set_type = function(id) {
        document.getElementById('order_type').value = id;

        var c = document.getElementsByClassName('type-radio-control2');

        for (var i = 0; i < c.length; i++) {
            c[i].className = 'type-radio-control';

        }
        document.getElementById('type_radio_' + id).className = 'type-radio-control2';
    };

   
</script>
@endsection