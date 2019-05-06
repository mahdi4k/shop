<footer class="container-fluid">
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
            <p class="footer-about text-justify">طراحی نسل جدید سیستمهای چند رسانه ایی خودرو برپایة سیستم عامل اندروید.
                در ابتدا با آپشن های موجود در بازار، تست کردن و رفع عیوب محصول، بعدازآن شروع به تولید و عرضه در بازار
                میشود.به طور همزمان تحقیق و توسعه شرکت درجهت ارتقاء محصول و آپشن های اختصاصی گام برداشته شود.محصولات
                ارائه شده در بازارایران کمتر درزمینه اندروید بوده درصورتی که علاقه مردم به سیستم های اندروید به دلیل
                راحتی کاربا آن و ارتقاء دادن آن و همچنین طیف گسترده تر نرم افزارها و ارتباط برقرارکردن با اینترنت بیشتر
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
                <a href=""> <i class="fab fa-telegram"></i></a>
                <a href=""> <i class="fab fa-instagram"></i></a>
                <a href=""> <i class="fab fa-twitter"></i></a>
                <a href=""> <i class="fab fa-facebook"></i></a>
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
</footer>

<script src="{{url('js/admin.js')}}"></script>
<script src="{{url('js/jquery.min.js')}}"></script>

<script src="{{url('js/js.js')}}"></script>
<script src="{{url('js/slick.js')}}"></script>
<script src="{{url('js/flipclock.min.js')}}"></script>
<script>

    $('.amazing').slick({
        rtl:true,
        speed: 900,
        slidesToShow: 3,
        slidesToScroll:2,
        variableWidth:true,
        infinite: false
    });
</script>
<script>


$('.new_product').slick({
    infinite: true,
    dots: true,
    speed: 1000,
    slidesToShow: 4,
    slidesToScroll: 4,
    rtl: true,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});


for (var j = 0; j < amazing_time.length; j++) {
    var clock;

    clock = $('#amazing_clock_' + j).FlipClock({
        clockFace: 'HourlyCounter',
        autoStart: false,
        id: 'c_' + j,
        callbacks: {
            stop: function () {
                var a = this.id.replace('c_', '');
                $('#amazing_clock_' + a).hide();
                $('#amazing_img_' + a).show();
            }
        }
    });

    clock.setTime(amazing_time[j]);
    clock.setCountdown(true);
    clock.start();
}


</script>
<script src="{{url('js/easing.jquery1.3.min.js')}}"></script>
<script src="{{url('js/custom.js')}}"></script>


    <script src="{{url('js/jquery.elevateZoom-3.0.8.min.js')}}"></script>
    <script>
        $(".zoom").elevateZoom({
            borderSize:1,
            zoomWindowPosition:"img_load_zoom",
            scrollZoom:true,
            cursor:'zoom-in',
            zoomWindowWidth:500,
            zoomWindowHeight:500,
            zoomLevel:0.5
        });
    </script>



</body>

</html>