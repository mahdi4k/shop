@extends('mobile.layout')
@section('title')
    اطلاعات ارسال
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

                            <span> اطلاعات ارسال سفارش</span>
                        </a>
                    </span>

                    <div class="rounded_rectangle_over step_shipping line_order"></div>

                    <span class="bullet login">
                        <a>
                            <span>بازبینی سفارش</span>
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
                <table id="address_table_<?= $value->id ?>" class=" user_address @if($key==0) active_address @endif">

                    <tr>
                        <td class="first_td" rowspan="3">


                            <div style="width:100%;position:absolute;top:-1px;right:0px">
                                <span id="span_action_<?= $value->id ?>" class="@if($key==0) active-address @else span_address @endif">
                                    <li class="icon-shopping-white-mark"></li>
                                </span>
                            </div>

                            <div id="address_radio_<?= $value->id ?>" class="@if($key==0) radio-control2 @else radio-control @endif" onclick="set_addrees('<?= $value->id ?>')">
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
                                <span class="fa fa-remove" onclick="del_row('<?= $value->id ?>','<?= url('remove_address') ?>','<?= Session::token() ?>')"></span>
                            </div>
                        </td>

                    </tr>

                    <tr>

                        <td>
                            <span>استان </span>
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
                            <div class="card border-active  border-primary add-border1 mb-3" style="max-width: 21rem;">
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
                                    <button id="addcheck" type="button" style="border-radius: 6px;padding: 8px;" class="  btn checked_custom_shipping  btn-primary  "><span> انتخاب روش ارسال</span></button>
                                </div>
                                <div class="card-footer text-center bg-transparent border-primary">هزینه ارسال 10000 هزار
                                    تومان
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-around">
                            <div class="card border-primary add-border2 mb-3" style="width: 21rem;">
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
                                    <button id="addcheck1" type="button" style="border-radius: 6px;padding: 8px;" class="btn btn-sm btn-primary  "><span>انتخاب روش ارسال</span></button>
                                </div>
                                <div class="card-footer text-center bg-transparent border-primary">هزینه ارسال پس کرایه</div>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="submit" value="ثبت اطلاعات و ادامه خرید" class="btn pull-left btn-info-custom-payment hvr-sweep-to-left" type="submit">  


            </div>
        </form>
        <div class="form-group" style="width:99%">

             

        </div>
    </div>

</div>

@include('site.include.new_address',['ostan'=>$ostan])



<div class="modal fade" id="edit_address" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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