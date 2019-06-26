@extends('Admin.master')
@section('header')
   ویرایش خبر
@endsection
@section('content')

 
        <div class="page-header ">
            <h2>ویرایش مقاله</h2>
        </div>
        <form action="{{route('news.update',['id'=>$news->id])}}  " method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PATCH')}}
            
            <div class="form-group col-md-12">
                <label for="title" class="control-label">عنوان مقاله</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="عنوان را وارد کنید" value="{{$news->title}}" >
            </div>
            <div class="form-group col-md-12">
                <label for="description" class="control-label">متن خبر</label>
                <textArea type="text" class=" ckeditor" name="description" id="description"     >{{$news->description}}</textArea>
            </div>
             
            
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="images" class="control-label">ویرایش تصویر</label>
                    <input type="file" class="form-control" name="images" id="images" >
                </div>
            </div>
            
           
            <p style="clear: both;margin-right: 15px;padding-top: 12px;">تصویر انتخاب شده : </p>
            <div class="col-sm-12">
                    <div class="row">
                         
                        <div class="col-md-4">
                            <label class="control-label">
                                  
                            <a target="_blank" href="{{$news->images['images']['original']}}"> <img src="{{$news->images['images']['original']}}" width="100%"> </a>
                            </label>
                        </div>
                        
                    </div>
                </div>

                <button type="submit" class="btn btn-lg mr-3 btn-success">ارسال</button>
        </form>
        

            
@endsection