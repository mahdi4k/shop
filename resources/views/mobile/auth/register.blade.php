@extends('mobile.layout')
@section('content')
<div class="container">
        <div class="row content_box">

            <div class="header_register">

                <div>
                    <li></li>
                    <h5>ثبت نام در هوشمند خودرو</h5>
                </div>

            </div>


                <div class="col-md-6 col-md-offset-3">
                     

                        <div class="register_form">
                            <form class="text-right" method="post" action="{{ route('register') }}">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <span>شماره همراه یا پست الکترونیک</span>
                                    <input type="text" value="{{ old('username') }}" class="form-control"
                                           name="username"
                                           placeholder="شماره موبایل یا ایمیل">
                                    @if($errors->has('username'))
                                        <span class="has-error">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <span>کلـــمه عبــور</span>
                                    <input type="password" class="form-control" name="password" placeholder="رمز عبور">
                                    @if($errors->has('password'))
                                        <span class="has-error">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div style="width:160px;margin:auto">
                                    <img src="{{ url('Captcha') }}" style="width:100%">
                                </div>

                                <div class="form-group">
                                    <span>کد امنیتی</span>
                                    <input type="text" class="form-control" name="captcha" placeholder="Captcha code">
                                    @if($errors->has('captcha'))
                                        <span class="has-error">{{ $errors->first('captcha') }}</span>
                                    @endif
                                </div>

                                <div class="form-group text-center">
                                    <button style="height:50px"  class="btn btn-info-custom hvr-sweep-to-left" >ثبت نام در هوشمند خودرو</button>
                                </div>


                            </form>
                        </div>

                    
                     
                </div>

        </div>
    </div>
@endsection