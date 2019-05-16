<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ورود به بخش مدیریت</title>

    <link href="{{ url('css/admin.css') }}" rel="stylesheet">
    <style>
        body {
            background: #360033;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #0b8793, #360033);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #0b8793, #360033); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            font-family: IRANSans;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            direction: rtl;
            background-color: #eff6f9;
            color: white;
        }
    </style>
</head>
<body>

<div class="container login_admin text-right mt-5 ">
    <div class="col-md-6 col-md-offset-3">
        <div class="login_box">

            <div class="header_login text-center">
                <img width="150" height="150" src="img/icon.gif">
                <h4>ورود به بخش مدیریت فروشگاه</h4>
            </div>
            <form method="post" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <span>نام کاربری</span>
                    <input type="text" value="{{ old('username') }}" class="form-control" name="username"
                           placeholder="نام کاربری">
                    @if($errors->has('username'))
                        <span class="has-error">{{ $errors->first('username') }}</span>
                    @endif
                </div>


                <div class="form-group">
                    <span>کلـــمه عبــور</span>
                    <input type="password" class="form-control" name="password" placeholder="کلمه عبور">
                    @if($errors->has('password'))
                        <span class="has-error">{{ $errors->first('password') }}</span>
                    @endif
                </div>



                <div class="form-group">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> مرا به خاطر بسپار

                </div>

                <div class="form-group">
                    <input type="submit"   class="btn btn-info" value="ورود به بخش مدیریت">
                </div>


            </form>
        </div>
    </div>
</div>
</body>
</html>
