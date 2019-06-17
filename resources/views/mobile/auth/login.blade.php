@extends('mobile.layout')
@section('content')
<div class="container-fluid login-register">


    <div class="row">

        <div class="col-md-6 col-xs-6 login-form">
            <span class="sign-in">
                <i class="fa fa-sign-in"></i>
            </span>
            <div style="text-align:center;margin-top:160px;">


                <p style="font-weight:bold;font-size:15px">عضو هوشمند خودرو هستید؟</p>
                <p style="font-size: 11px;color: #716666;">برای تکمیل فرآیند خرید خود وارد شوید</p>
                <button onclick="show_login_form()" class="btn btn-primary">ورود به سایت</button>
            </div>
        </div>
        <div class="col-md-6 col-xs-6 register-form">
            <span class="user-plus"> <i class="fa fa-user-plus"></i></span>
            <div class="right_login_box">

                <div style="text-align:center;padding-top: 160px;">

                    <p style="font-weight:bold;font-size:15px">تازه وارد هستید؟</p>
                    <p style="font-size: 11px;color: #716666;">برای تکمیل فرآیند خرید ثبت نام کنید</p>
                    <a class="btn btn-success" href="{{ url('register') }}">ثبت نام در سایت</a>

                     
                </div>

            </div>


        </div>

    </div>

</div>



<div id="show_data"></div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button style="position: absolute !important" type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h5 class="modal-title  text-center w-100 " id="myModalLabel">ورود به سایت</h5>
            </div>
            <div class="modal-body">

                <div class="register_form text-right">
                    <form method="post" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group w-100">
                                    <label for="inputAddress">شماره همراه یا پست الکترونیک</label>
                                <input type="text" value="{{ old('username') }}" class="form-control" name="username"
                                    id="inputAddress">
                               
                                 

                            </div>
                        </div>
                        @if($errors->has('username'))
                        <span class="has-error">{{ $errors->first('username') }}</span>
                        @endif


                        <div class="form-row">
                            <div class="form-group w-100">
                                    <label for="inputPaswword">کلمه عبور</label>
                                <input type="password" class="form-control" name="password" id="inputPaswword">
                                
                                 
                            </div>
                        </div>
                        @if($errors->has('password'))
                        <span style="color: red;font-size: 10pt">{{ $errors->first('password') }}</span>
                        @endif
                        <div class="form-group custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck" name="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="custom-control-label" for="customCheck"> مرا به خاطر بسپار</label>
                        </div>

                        <div class="form-group text-center">
                            <input type="submit" style="width:150px" class="btn btn-info" value="ورود به سایت">
                            <a class="btn btn-light" style=" padding-right: 10px;" href="">بازیابی کلمه عبور</a>
                        </div>


                    </form>
                </div>


            </div>
             
        </div>
    </div>
</div>
@endsection
@section('script')
<?php
    $url1 = url('site/ajax_check_login');
    ?>
<script>
    show_login_form = function () {
            $.ajaxSetup(
                {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                url: '{{ $url1 }}',
                type: 'POST',
                success: function (data) {
                    $("#show_data").html(data);
                }
            });
        };

</script>
@if($errors->has('username') or $errors->has('password'))
<script>
    $("#myModal").modal('show');
</script>
@endif

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
@endsection()