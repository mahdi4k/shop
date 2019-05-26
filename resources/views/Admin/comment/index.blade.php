@extends('Admin.master')
@section('header')
     مدیریت نظرات کاربران 
@endsection

@section('content')

    <div class="box_title">
        <span>مدیریت نظرات کاربران</span>
    </div>


    <div>
        <?php

        $item_name=array();
        $item_name[1]='کيفيت ساخت';
        $item_name[2]='ارزش خريد به نسبت قيمت';
        $item_name[3]='نوآوري';
        $item_name[4]='امکانات و قابليت ها';
        $item_name[5]='سهولت استفاده';
        $item_name[6]='طراحي و ظاهر';
        ?>

        @if(sizeof($score)>0)

            @php
                function score_check($score,$n)
                {
                      $a=0;
                      if($score)
                      {
                          $e=explode('@#',$score->value);
                          foreach ($e as $key=>$value)
                          {
                              $k=$n.'_';
                              $c=explode($k,$value);
                              if(sizeof($c)==2)
                              {
                                 $a=$c[1];
                              }
                          }
                      }
                      return $a;
                }
            @endphp
            @foreach($score as $key=>$value)

                <div class="row user_comment_box" style="width:97%;margin:20px auto">


                    <div class="comment_header">

                        <?php
                        $jdf=new \App\lib\Jdf();
                        $comment=$value->get_comment;
                        ?>
                        <div style="float: right;">
                            @if(!empty($value->get_user->name))

                                <p>{{ $value->get_user->name }}</p>
                            @else
                                <p>
                                    <span>
                                        کاربر سایت
                                    </span>
                                    <span>
                                        - {{ $value->get_product->title }}
                                    </span>
                                </p>

                            @endif
                            <p style="font-size:11px">{{ $jdf->jdate('n F y',$value->time) }}</p>
                        </div>
                            @if($comment)
                                <div style="float:left" id="user_comment_{{ $comment->id }}">
                                    @if($comment->status==0)
                                        <span class="btn btn-info" onclick="set_comment_status('{{ $comment->id }}')" style="margin-left: 15px; cursor:pointer;">تایید نظر</span>
                                    @else

                                        <span class="btn btn-success" onclick="set_comment_status('{{ $comment->id }}')" style="margin-left: 15px;cursor:pointer;">تایید شده</span>
                                    @endif
                                </div>
                            @endif

                            <a class="btn btn-warning" style="color:white;float:left;margin-left:10px;cursor:pointer;" onclick="del_row('<?php echo $comment->id ?>','<?= url('admin/comment') ?>','<?= Session::token() ?>')">
                                
                                 حذف نظر کاربر 
                            </a>
                        <div style="clear:both"></div>
                    </div>
                    <div class="col-md-6" >
                        <ul class="rang_ul" >


                            @foreach($item_name as $k=>$v)

                                <li>
                                    <span>{{ $v }}</span>
                                    <div class="rating-container">
                                        <div class="bar @if(score_check($value,$k)>=1) done @endif"></div>
                                        <div class="bar @if(score_check($value,$k)>=2) done @endif"></div>
                                        <div class="bar @if(score_check($value,$k)>=3) done @endif"></div>
                                        <div class="bar @if(score_check($value,$k)>=4) done @endif"></div>
                                        <div class="bar @if(score_check($value,$k)==5) done @endif"></div>
                                    </div>
                                </li>

                            @endforeach
                        </ul>
                        <div style="clear:both;padding-top: 30px;"></div>
                    </div>


                    @if($comment)

                        <div class="col-md-6">


                            <p style="margin-top: 35px;">{{ $comment->subject }}</p>

                            @if(!empty($comment->advantages))
                                <p style="color:green;padding-top:10px">نقاط قوت</p>
                                <?php
                                $advantages=explode('@$E@',$comment->advantages);
                                ?>
                                @foreach($advantages as $key=>$value)
                                    @if(!empty($value))
                                        <p>
                                            <span class="icon icon-arrow-top"></span>
                                            <span class="icon_span">{{ $value }}</span>
                                        </p>
                                    @endif
                                @endforeach
                            @endif

                            @if(!empty($comment->disadvantages))
                                <p style="color:red;padding-top:10px">نقاط ضعف</p>
                                <?php
                                $disadvantages=explode('@$E@',$comment->disadvantages);
                                ?>
                                @foreach($disadvantages as $key=>$value)
                                    @if(!empty($value))
                                        <p>
                                            <span class="icon icon-arrow-down"></span>
                                            <span class="icon_span">{{ $value }}</span>
                                        </p>
                                    @endif
                                @endforeach
                            @endif

                            <div style="text-align:justify;width:95%;padding-bottom:30px;">{{ $comment->comment_text }}</div>



                             
                        </div>

                    @endif
                </div>

            @endforeach

            {!!  str_replace('site/ajax_get_tab_data','product/comment',$score->render()) !!}

        @else

        @endif
    </div>
@endsection

@section('footer')
<script>
<?php
$url=url('admin/ajax/set_comment_status');
?>
set_comment_status=function(id)
{
    $.ajaxSetup(
        {
            'headers':{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
    $("#user_comment_"+id).html('در حال اجرای درخواست ...');
    $.ajax({
        url:'{{ $url }}',
        type:'POST',
        data:'comment_id='+id,
        success:function (data)
        {
            var html='<span class="btn btn-info"  onclick="set_comment_status('+id+')" style="margin-left: 15px; cursor:pointer;">' +
                data +
                '</span>';

            $("#user_comment_"+id).html(html);
        }
    });
}
</script>
@endsection
