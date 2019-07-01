<section id="third-carousel">
    <div class="new-product">
        <div class="container">
            <div class="row">
                <div class=" featured-product-home">
                    <div class="title order-title  ">
                        <h2 class="text-center">جدیدترین محصولات</h2>
                    </div>


                    <div class="shop_product">


                        <section class="new_product">
                            @foreach($product as $key=>$value)
                            <div class="product_box">

                                @if($value->get_img)
                                <a href="{{ url('product').'/'.$value->code_url.'/'.$value->title_url }}">
                                    <div class="product_image_box">
                                        <img src="{{ url('upload').'/'.$value->get_img->url }}">
                                    </div>
                                </a>
                                @endif


                                <p>
                                    <a href="{{ url('product').'/'.$value->code_url.'/'.$value->title_url }}">
                                        @if(strlen($value->title)>50)
                                        {{ mb_substr($value->title,0,33).' ... ' }}
                                        @else
                                        {{ $value->title }}
                                        @endif
                                    </a>
                                </p>
                                <a href="{{ url('product').'/'.$value->code_url.'/'.$value->title_url }}">
                                    <p class="product_discounts" @if(!empty($value->discounts) && !empty($value->price))
                                        style="background: #F5F6F7;" @endif>

                                        @if(!empty($value->discounts) && !empty($value->price))
                                        {{ arabic_w2e( number_format($value->price)) }} تومان
                                        @endif

                                    </p>


                                    <p class="product_price">
                                        @if(!empty($value->discounts) && !empty($value->price))

                                        {{ arabic_w2e( number_format($value->price - $value->discounts)) }}
                                        تومان
                                        @elseif(!empty($value->price))

                                        {{ arabic_w2e( number_format($value->price)) }} تومان
                                        @endif

                                    </p>
                                </a>
                            </div>
                            @endforeach
                        </section>


                    </div>


                </div>
            </div>
        </div>
    </div>
</section>