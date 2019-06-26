@extends('Admin.master')
@section('header')
   خبر ها
@endsection
@section('content')
 
        <div class="page-header ">
            <h2>خبرها</h2>
            <a href="{{route('news.create')}}" class="btn btn-primary btn-sm">ارسال خبر</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>عنوان خبر</th>
                    <th>تعداد نظرات</th>
                    <th>تعداد بازدید</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>


                @foreach($News as $article)
                    <tr>
                        <td><a href="{{$article->path()}}"> {{$article->title}}</a></td>
                        <td>{{$article->commentCount}}</td>
                        <td>{{$article->viewCount}}</td>

                        <td>
                            <form action="{{ route('news.destroy',['id'=>$article->id])}}" method="post">
                                {{method_field('delete')}}
                                {{csrf_field()}}
                                <div class="btn-group btn-group-xs">
                                    <a href="{{ route('news.edit' , ['id'=>$article->id])}}"
                                       class="btn btn-warning">ویرایش</a>
                                    <button type="submit" class="btn btn-danger">حذف</button>

                                </div>
                            </form>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>
        <div style="text-align: center">
            {!! $News->render() !!}
        </div>
    
@endsection