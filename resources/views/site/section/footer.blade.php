<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-8">
                <div class=" sta-title col-sm-8 col-md-4 col-md-offset-2">
                    <p><i class="fa fa-phone-square"></i>ارتباط با ما</p>
                </div>
                <div class="clearfix"></div>
                <ul class="site-sta">
                    <li><i class="fa fa-map-marker"></i>پارک علم و فناوری</li>
                    <li style="font-size: 16px;"><i class="fa fa-envelope"></i>info@hooshmandkhodro.com</li>
                    <li><i class="fa fa-phone"></i>۰۳۵۳-۸۴۱۲۰۱۶</li>

                </ul>
            </div>

            <div class="col-md-3 col-sm-8">
                <div class=" about-title col-sm-8 col-md-4 col-md-offset-2">
                    <p><i class="fa fa-users"></i>گروه هیراد</p>
                </div>
                <div class="clearfix"></div>
                <p class="footer-about text-justify">طراحی نسل جدید سیستمهای چند رسانه ایی خودرو برپایة سیستم عامل
                    اندروید.
                    در ابتدا با آپشن های موجود در بازار، تست کردن و رفع عیوب محصول، بعدازآن شروع به تولید و عرضه در
                    بازار
                    میشود.به طور همزمان تحقیق و توسعه شرکت درجهت ارتقاء محصول و آپشن های اختصاصی گام برداشته شود.محصولات
                    ارائه شده در بازارایران کمتر درزمینه اندروید بوده درصورتی که علاقه مردم به سیستم های اندروید به دلیل
                    راحتی کاربا آن و ارتقاء دادن آن و همچنین طیف گسترده تر نرم افزارها و ارتباط برقرارکردن با اینترنت
                    بیشتر
                    می باشد. </p>
            </div>

            <div class="col-md-3 col-sm-8">
                <div class=" about-title col-sm-8 col-md-4 col-md-offset-2">
                    <p><i class="fa fa-th-list"></i>مجوز ها</p>
                </div>
                <div class="clearfix"></div>
                <ul class="License">
                    <li><i class="fa fa-image"></i> <a target="_blank" href=" /img/2.jpg ">مجوز فناوری</a></li>
                    <li><i style="margin-left: 4px" class="fa fa-image"></i><a target="_blank" href=" /img/1.jpg ">مجوز
                            فعالیت</a></li>
                </ul>
                <img class="img-enamad" src="{{URL::asset('/img/enamad.png')}}">

            </div>
            <div class="col-md-3 col-sm-8">
                <div class=" about-title col-sm-8 col-md-4 col-md-offset-2">
                    <p><i class="fa fa-bookmark-o"></i>شَبکه اجتماعی</p>
                </div>
                <div class="social-network">
                    <a href=""> <i class="fa fa-telegram"></i></a>
                    <a href=""> <i class="fa fa-instagram"></i></a>
                    <a href=""> <i class="fa fa-twitter"></i></a>
                    <a href=""> <i class="fa fa-facebook"></i></a>
                </div>
                <p class="text-center no-margin">عضویت در خبرنامه</p>
                <input type="email" class="original-control" placeholder="ایمیل" aria-label="Username">
                <button type="submit" class="btn inside-btn btn-primary">ارسال</button>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12 footer-nav">
                <h5 class="text-center copy-right"> تمامی فعاليت‌هاي سایت، تابع قوانين و مقررات جمهوري اسلامي ايران می
                    باشد</h5>

            </div>
        </div>
    </div>
</footer>


<script src="{{url('js/js.js')}}"></script>
<script src="{{url('js/slick.js')}}"></script>
<script src="{{url('js/flipclock.min.js')}}"></script>

<script src="{{url('js/easing.jquery1.3.min.js')}}"></script>


@yield('footer_site')


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
    $(document).ready(function(){
  $("#myBtn").click(function(){
    $("#myModal").modal();
  });
});
</script>
<script>
    search=function () {

var search_text=document.getElementById('inputGroupSuccess1').value;
if(search_text.trim()!='')
{
    if(search_text.trim().length>2)
    {
        $("#search_product_form").submit();
    }

}


}
</script>

@endif
<script>
    <?php
            $url = url('site/ajax_del_cart');
            
           ?>
            del_product_cart = function (p_id, s_id, c_id) {
            $.ajaxSetup(
                {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                url: '{{ $url }}',
                type: 'POST',
                data: 'service_id=' + s_id + '&product_id=' + p_id + '&color_id=' + c_id,
                success: function (data) {
                    $("#delete-mini-cart").html(data);
                }
            });
        };
</script>
</body>

</html>