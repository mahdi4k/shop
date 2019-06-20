@extends('site.master')
@section('title')
    گروه هیراد کویر- بازیابی کلمه عبور
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card m-5">
                <div style="text-align:center" class="card-header">{{ __('بازیابی کلمه عبور') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row d-flex justify-content-center p-2">
                            <label for="email" class="pull-left">{{ __('  ایمیلی که با آن ثبت نام کردین :') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="email" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 d-flex justify-content-center">
                             
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ارسال لینک بازیابی رمز عبور') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
