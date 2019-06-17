@extends('site.master')
@section('title')
    گروه هیراد کویر-ورود به سایت
@endsection
@section('content')

    <div class="container-fluid login-register">


        <div class="row">

            <div class="col-md-6 login-form">
<span class="sign-in">
    <i class="fa fa-sign-in"></i>
</span>
                <div style="text-align:center;margin-top:60px;">


                    <p style="font-weight:bold">عضو هوشمند خودرو هستید؟</p>
                    <p>برای تکمیل فرآیند خرید خود وارد شوید</p>
                    <button onclick="show_login_form()" class="btn btn-primary">ورود به سایت</button>
                </div>
            </div>
            <div class="col-md-6 register-form">
                <span class="user-plus">  <i class="fa fa-user-plus"></i></span>
                <div class="right_login_box">

                    <div style="text-align:center;padding-top: 60px;">
                        
                        <p style="font-weight:bold">تازه وارد هستید؟</p>
                        <p>برای تکمیل فرآیند خرید خود ثبت نام کنید</p>
                        <a class="btn btn-success" href="{{ url('register') }}">ثبت نام در سایت</a>

                        <div style="padding-top:30px;padding-bottom:30px;width:80%;margin:auto">
                            با عضویت در دیجی‌کالا تجربه متفاوتی از خرید اینترنتی داشته باشید. وضعیت سفارش خود را پیگیری
                            نموده و سوابق خریدتان را مشاهده کنید.
                        </div>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title  text-center w-100 " id="myModalLabel">ورود به سایت</h5>
                </div>
                <div class="modal-body">

                    <div class="register_form text-right">
                        <form method="post" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="form-group w-100">

                                    <input type="text" value="{{ old('username') }}" class="form-control" name="username" id="inputAddress">
                                     <label for="inputAddress">شماره همراه یا پست الکترونیک</label>
                                    <div class="line"></div>

                                </div>
                            </div>
                            @if($errors->has('username'))
                                <span class="has-error">{{ $errors->first('username') }}</span>
                            @endif


                            <div class="form-row">
                                <div class="form-group w-100">

                                    <input type="password" class="form-control" name="password" id="inputPaswword">
                                    <label for="inputPaswword">کلمه عبور</label>
                                    <div class="line"></div>
                                </div>
                            </div>
                            @if($errors->has('password'))
                                <span style="color: red;font-size: 10pt">{{ $errors->first('password') }}</span>
                            @endif
                            <div class="form-group custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck"
                                       name="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="custom-control-label" for="customCheck"> مرا به خاطر بسپار</label>
                            </div>

                            <div class="form-group text-center">
                                <input type="submit" style="width:150px" class="btn btn-info" value="ورود به سایت">
                                <a class="btn btn-light" style=" padding-right: 10px;" href="">بازیابی کلمه عبور</a>
                            </div>


                        </form>
                    </div>


                </div>
                <div style="background-color: #dae1f1;" class="login_footer text-center">

                      <span>
            قبلاً در سایت ثبت نام نکرده اید؟</span>
                    <a class="btn  mb-1" href="{{ url('register') }}">ثبت نام در سایت</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_site')
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
@endsection
