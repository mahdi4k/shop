@extends('site.master')
@section('content')
    <div class="row content_box">


        <div class="col-md-5"  style="padding-bottom:50px">

            <div style="margin-top:30px;width:100%;float:right;">
                <div class="products-availability-image"></div>
                <div style="float: left;">
                    <ul class="list-inline">
                        <li><span class="current-product-3d"></span></li>

                        <li><span class="icon-statistics"></span></li>
                        <li><span class="icon-love"></span></li>
                    </ul>
                </div>
            </div>
            <?php
            $images=$product->get_images;
            ?>
            <div class="show_product_img">
                @if(sizeof($images)>0)
                    <img class="zoom" src="{{ url('upload').'/'.$images[0]->url }}"  data-zoom-image="{{ url('upload').'/'.$images[0]->url }}">
                @endif
            </div>
            <div class="img_box">
                @foreach($images as $key=>$value)

                    @if($key<3)
                        <img onclick="change_img('<?= url('upload').'/'.$value->url ?>')" src="{{ url('upload').'/'.$value->url }}">
                    @endif

                @endforeach

                @if(sizeof($images)>3)

                    <div class="show_more_img" onclick="show_more_img()">
                        <div></div>
                    </div>
                @endif

            </div>
        </div>

        <div class="col-md-7">

            <div id="img_load_zoom"></div>
            <div class="show_product_title">
                <div class="col-md-9">
                    <h4>{{ $product->title }}</h4>
                    <p>{{ $product->code }}</p>
                </div>
                <div class="col-md-3">

                    <?php
                    $avg=collect($score_data['score'])->avg();
                    $avg=substr($avg,0,4);
                    $width=$avg*20;
                    ?>
                    <div class="rating">
                        <div class="gray">
                            <div class="red" style="width:{{ $width }}%"></div>
                        </div>
                    </div>
                    <div style="width:100px;margin:5px auto">

                        <p  style="font-size:10px;"> از {{ $score_data['total'] }} رای </p>
                    </div>
                </div>
                <div style="clear:both">
                </div>
            </div>


            @if($product->product_status==1)

                <form method="post" action="{{ url('Cart') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <?php
                    $colors=$product->get_colors;
                    $color_id=0;
                    ?>

                    <div id="product_info">
                        <?php
                        $color_id=0;
                        $service_id=0;
                        ?>
                        @if(sizeof($colors)>0)
                            <p style="padding-top: 20px;">انتخاب رنگ</p>
                            @foreach($colors as $key=>$value)
                                @if($key==0)
                                    <?php $color_id=$value->id ?>
                                @endif
                                <div class="color_box" onclick="set_color('<?= $value->id ?>')">
                                    <label style="background:#{{ $value->color_code }}"> @if($key==0) <span class="tick"></span> @endif</label>
                                    <span>{{ $value->color_name }}</span>
                                </div>
                            @endforeach
                        @endif
                        <input type="hidden" name="color_id" id="color_id" value="{{ $color_id }}">

                        <div style="width:100%;float: right;">

                            @if(sizeof($product->get_service_name)>0)

                                <p style="padding-top:20px">انتخاب گارانتی</p>



                                <?php
                                $c=0;
                                ?>
                                @foreach($product->get_service_name as $key=>$value)

                                    @if($color_id==0)

                                        @if($key==0)
                                            <div class="service_title" onclick="show_service()">
                                                <span>{{ $value->service_name }}</span>
                                                <a class="service_ic" id="service_ic"></a>
                                            </div>
                                            <?php
                                            $service_id=$value->id;
                                            ?>
                                        @endif
                                    @else

                                        <?php

                                        if($c==0)
                                        {
                                        $check=DB::table('service')->where(['parent_id'=>$value->id,'color_id'=>$color_id])->first();
                                        if($check)
                                        {
                                        $c=1;
                                        ?>
                                        <div class="service_title" onclick="show_service()">
                                            <span>{{ $value->service_name }}</span>
                                            <a class="service_ic" id="service_ic"></a>
                                        </div>
                                        <?php
                                        $service_id=$value->id;
                                        ?>

                                        <?php
                                        }
                                        }
                                        ?>


                                    @endif

                                @endforeach

                                <div class="service_box" id="service_box">
                                    @foreach($product->get_service_name as $key=>$value)
                                        <div onclick="set_service('<?= $value->id ?>')">
                                            {{ $value->service_name }}
                                        </div>
                                    @endforeach
                                </div>

                            @endif
                            <input type="hidden" name="service_id" value="{{ $service_id }}" id="service_id">


                        </div>


                        <div style="width:100%;float:right;margin-top: 15px;">

                            <p><span>قیمت : </span> {{ number_format($product->price) }} تومان</p>
                            @if(!empty($product->discounts))
                                <p><span>قیمت برای شما : </span>  <span style="color:#4CAF50;font-size:16px;">{{ number_format($product->price-$product->discounts) }}</span>  تومان</p>
                            @endif


                            <input type="submit" class="btn btn-success" value="افزودن به سبد خرید">
                        </div>

                    </div>
                </form>
            @endif


        </div>
    </div>
@endsection
