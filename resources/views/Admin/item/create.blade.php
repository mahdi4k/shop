@extends('Admin.master')

@section('header')

    افزودن ویژگی محصولات
@endsection


@section('content')

    <div class="box_title">
        <span>افزودن ویژگی محصولات</span>
    </div>

    @if(isset($id))
        {!! Form::open(['url'=>'admin/item?id='.$id,'files'=>'true']) !!}
    @endif

    <div class="form-group">
        {!! Form::label('cat_id','انتخاب سر دسته : ') !!}
        {!! Form::select('cat[]',$cat_list,$id,['class'=>'selectpicker','data-live-search'=>'true','id'=>'cat_list','onchange'=>'get_item()']) !!}

    </div>
    <div class="form-group" id="item_box">


        @foreach($item as $key=>$value)

            <div id="item_div_{{ $value->id }}" style="width:100%;float:right;margin-top:10px;margin-bottom:5px;border: 2px dashed #1ebdbf;padding:20px" class="product_item_div">
                <label style="font-weight:bold;display:block;background: aliceblue;padding:5px;"">نام گروه</label>
                <input name="item_name[{{ $value->id }}]" value="{{ $value->name }}" type="text"  style="float: right;" class="form-control" placeholder="نام گروه" >


             @foreach($value->get_child as $key2=>$value2)

                <div class="child_item">
                    <label style="padding-top:15px;font-weight:bold;border-bottom: 3px dashed #e02d4a;">نام آیتم</label>
                    <input value="{{ $value2->name }}" type="text" name="child_item[{{ $value->id }}][{{ $value2->id }}]" style="float: right; margin-bottom:8px" class="form-control" placeholder="نام آیتم">
                    <select name="child_filed[{{ $value->id }}][{{ $value2->id }}]" class="form-control" style="float:right;margin-right:10px">
                        <option @if($value2->filed==1) selected="selected" @endif  value="1">فیلد input</option>
                        <option @if($value2->filed==2) selected="selected" @endif value="2">فیلد select</option>
                        <option @if($value2->filed==3) selected="selected" @endif value="3">فیلد textarea</option>
                        </select>
                    </div>

             @endforeach



         </div>
            <div class="form-group" style="margin-right:0px;margin-bottom:0px;">
                <span class="fa fa-plus" style="color:red;cursor:pointer;padding-top:15px" onclick="add_child_item('item_div_{{ $value->id }}','{{ $value->id }}')"><p style="color:#6f6868;display: inline-block;
                    font-family: iransans;">افزودن آیتم</p></span>
            </div>
        @endforeach

    </div>
    @if(isset($id))
 
        <div class="form-group">

            <span class="fa fa-plus" style="color:red;cursor:pointer;padding-top:15px" onclick="add_item()"><p style="color:#6f6868;display: inline-block;
                font-family: iransans;">افزودن گروه</p></span>

        </div>

        <div class="form-group">
            {!! Form::submit('ثبت',['class'=>'btn btn-success']) !!}
        </div>

        {!! Form::close() !!}

    @endif
    <script>
        get_item=function ()
        {
            var cat_id=document.getElementById('cat_list').value;
            window.location='<?= url('admin/item') ?>?id='+cat_id;
        };
    </script>


@endsection


