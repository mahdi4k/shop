<div class="row" id="data_question">


    <div style="width:95%;margin:auto">


        @if(auth()->check())

            <p style="padding-top:20px;padding-bottom:5px;color:red">{{ Session::pull('status') }}</p>
            <p id="answer_p"></p>
            <form action="{{ url('add_question') }}" method="post" id="add_question">
                {{ csrf_field() }}
                <input type="hidden" name="product_id" value="{{ $product_id }}">
                <input type="hidden" name="parent_id" id="parent_id" value="0">
                <textarea placeholder="متن پرسش خود را اینجا بنویسید ..." name="question"
                          class="question_test"></textarea>
                <p>
                    @if(Session::has('error_question'))
                        <span class="has-error">{{ Session::get('error_question') }}</span>
                    @endif
                </p>
                <button class="btn btn-primary" style="float: left;">ثبت پرسش</button>
            </form>


        @else
            <div class="question-auth text-center mt-3">
                <p>برای ثبت پرسش لطفا ابتدا وارد سایت شوید</p>

                <button onclick="show_login_form()" class="btn btn-info-custom hvr-sweep-to-left">ورود به سایت</button>

                <div id="show_data"></div>
            </div>
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

                                            <input type="text" value="{{ old('username') }}" class="form-control"
                                                   name="username" id="inputAddress">
                                            <label for="inputAddress">شماره همراه یا پست الکترونیک</label>
                                            <div class="line"></div>

                                        </div>
                                    </div>
                                    @if($errors->has('username'))
                                        <span class="has-error">{{ $errors->first('username') }}</span>
                                    @endif


                                    <div class="form-row">
                                        <div class="form-group w-100">

                                            <input type="password" class="form-control" name="password"
                                                   id="inputPaswword">
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
                                        <input type="submit" style="width:150px" class="btn btn-info"
                                               value="ورود به سایت">
                                        <a class="btn btn-light" style=" padding-right: 10px;" href="">بازیابی کلمه
                                            عبور</a>
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


        @endif


        <div style="padding-top:20px;clear:both"></div>

        @if(sizeof($question)>0)


            @foreach($question as $key=>$value)

                <div class="row user_comment_box" style="width:100%;margin:20px auto">

                    <div class="comment_header">

                        <?php
                        $jdf = new \App\lib\Jdf();
                        ?>
                        <span style="padding-right:10px">پرسش</span>

                        <span style="float:left;padding-left: 10px;">توسط {{ $value->get_user->name }}
                            - {{ $jdf->jdate('n F y',$value->time) }}</span>
                    </div>


                    <div style="padding: 15px;">
                        {!!   strip_tags(nl2br($value->question),'<p><br>') !!}
                    </div>


                    <div class="answer_box">
                        @foreach($value->get_parent as $key2=>$value2)

                            <div style="width:95%;margin:auto">

                                <div style="width:100%;border-bottom: 1px solid #e5e5e5;">
                                    <p>
                                        @if(empty($value2->get_user->name))
                                            ناشناس
                                        @else
                                            {{ $value2->get_user->name }}
                                        @endif
                                    </p>
                                    <p>
                                        {{ $jdf->jdate('n F y',$value2->time) }}
                                    </p>
                                </div>

                                <div style="padding-top:15px;padding-bottom:15px;">
                                    <p>پاسخ:</p>
                                    {!!   strip_tags(nl2br($value2->question),'<p><br>') !!}
                                </div>

                            </div>

                        @endforeach
                    </div>

                </div>
                <button class="pull-left btn btn-xs btn-success" data-toggle="modal" data-target="#sendCommentModal"
                        data-parent="{{$value->id}}">پاسخ
                </button>
                <div class="modal fade" id="sendCommentModal" tabindex="-1" role="dialog"
                     aria-labelledby="sendCommentModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">ارسال پاسخ</h4>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('add_question') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="product_id" value="{{ $product_id }}">
                                    <input type="hidden" name="parent_id" value="0">
                                    <input type="hidden" name="commentable_id" value="">

                                    <div class="form-group">

                                        <textarea class="form-control" rows="8" name="question"></textarea>
                                        <label class="control-label">متن پاسخ:</label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">ارسال</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">انصراف
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div style="clear: both"></div>
            @endforeach


            {!!  str_replace('id="pagination"','id="question"',$question->render()) !!}

        @else

            <p style="color:red;text-align:center;padding-top:60px;padding-bottom:20px">تاکنون پرسشی ثبت نشده</p>

        @endif
    </div>

</div>

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
    <?php

    $url2 = url('site/ajax_get_tab_data');
    ?>
    $('#question a').click(function (event) {
        event.preventDefault();
        event.preventDefault();
        var url = $(this).attr('href');
        var url = url.split('page=');
        var product_id = '<?= $product_id ?>';
        if (url.length == 2) {
            $("#loading_question").show();
            $("#question_box").hide();
            $.ajaxSetup(
                {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            $.ajax({
                url: '{{ $url2 }}?page=' + url[1],
                type: 'POST',
                data: 'tab_id=question&product_id=' + product_id,
                success: function (data) {
                    $("#question_box").show();
                    $("#loading_question").hide();
                    $("#question_box").html(data);
                }
            });
        }

    });
    $('#sendCommentModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let parentId = button.data('parent');
        let modal = $(this);
        modal.find("[name='parent_id']").val(parentId);
    });

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
