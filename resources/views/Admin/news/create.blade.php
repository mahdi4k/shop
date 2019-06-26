@extends('Admin.master')
@section('header')
   افزودن خبر
@endsection
@section('content')
{!! Form::open(['url'=>'admin/news','files'=>'true']) !!}
<div class="form-group">
    {!! Form::label('title','عنوان خبر : ') !!}
    {!! Form::text('title',null,['class'=>'form-control','style'=>'width:75%']) !!}
    @if($errors->has('title'))
        <span style="color:red;font-size:13px">{{ $errors->first('title') }}</span>
    @endif
</div>

<div class="form-group">
        {!! Form::label('title','متن خبر : ') !!}
    {!! Form::textArea('description',null,['class'=>'ckeditor']) !!}
    @if($errors->has('description'))
        <span style="color:red;font-size:13px">{{ $errors->first('description') }}</span>
    @endif
</div>
<div class="form-group">
        <div class="col-sm 6">
        <label for="images" class="control-label">تصویر اصلی</label>
        <input type="file" class="form-control" name="images" id="images" >
    </div>
<div class="form-group">
    {!! Form::submit('ثبت',['class'=>'btn btn-success']) !!}
</div>

{!! Form::close() !!}
@endsection