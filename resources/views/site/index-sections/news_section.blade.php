<section id="news">


    <div class="container-fluid news-section ">

        <div class="title order-title  ">
            <h2 class="text-center">آخرین اخبار سایت</h2>
        </div>
        <div class="p-3">
            <div class="row">
                @foreach ($news_all as $item)
                <div class="col-md-3">
                    <div class="all-news">
                        <div class="img-news position-relative">
                            <span class="date-news"> {{arabic_w2e(jdate($item->created_at)->format('%A, %d %B %y'))}}
                            </span>
                            <figure class="shin">
                                <a href="{{ route('news.single' , ['news' => $item->id ]) }}">
                                    <img width="100%" src="{{$item->images['images']['300']}}">
                                </a>
                            </figure>

                        </div>
                        <div class="panel-content">
                            <a class="news-title"
                                href="{{ route('news.single' , ['news' => $item->id ]) }}">{{str_limit($item->title,54)}}</a>
                            <a href="{{ route('news.single' , ['news' => $item->id ]) }}"
                                class="btn btn-info btn-sm btn-sm-custom mr-2" role="button">ادامه خبر</a>
                        </div>
                        <div class="p-details">
                            <i class="fa fa-eye"></i>
                            <span class="mr-1">{{arabic_w2e($item->viewCount)}}</span>
                            <i style="position:absolute;left:20px; color:skyblue"
                                class="fa fa-user pull-left">-ادمین</i>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-md-3">
                    <div class="all-news">
                        <div class="img-news position-relative">
                            <span class="date-news">چهارشنبه, ۲۲ خرداد ۱۳۹۸</span>
                            <figure>
                                <img width="100%" src="{{url('img/php.jpg')}}">
                            </figure>

                        </div>
                        <div class="panel-content">
                            <a>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a>
                        </div>
                        <div class="p-details">
                            <i class="fa fa-eye"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="all-news">
                        <div class="img-news position-relative">
                            <span class="date-news">چهارشنبه, ۲۲ خرداد ۱۳۹۸</span>
                            <figure>
                                <img width="100%" src="{{url('img/php.jpg')}}">
                            </figure>

                        </div>
                        <div class="panel-content">
                            <a>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a>
                        </div>
                        <div class="p-details">
                            <i class="fa fa-eye"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="all-news">
                        <div class="img-news position-relative">
                            <span class="date-news">چهارشنبه, ۲۲ خرداد ۱۳۹۸</span>
                            <figure>
                                <img width="100%" src="{{url('img/php.jpg')}}">
                            </figure>

                        </div>
                        <div class="panel-content">
                            <a>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a>
                        </div>
                        <div>
                            <i class="fa fa-eye"></i>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>




</section>