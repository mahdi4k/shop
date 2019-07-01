<div class="container-fluid mt-4">
     
    <div id="slider2">
     
    
        <div id="slider2_content">
                @foreach($amazing as $key=>$value)
                <?php
  
                $url=url('').'/product/';
                if($value->get_product)
                {
                   $url.=$value->get_product->code_url.'/'.$value->get_product->title_url;
                }
                ?>
            <a class="item">
               

                  
                <div class="slider2_content_right">


                    <div class="title order-title  ">
                        <h2 class="text-right mt-0">پیشنهادات ویژه امروز</h2>
                    </div>

                    
                    <div class="title_title">
                        <p >ویژگی های محصول</p>
                            <ul class="list-group">

                                <li class="list-group-item">
                                    {!! $value->tozihat  !!}
                                </li>
                            </ul>
                            
                        </div>
                </div>
                
                <div class="slider2_content_left">

                    <h3>
                       {{str_limit($value->title,40)}}
                    </h3>
                    @if($value->get_img)
                    <img src="{{url('upload').'/'.$value->get_img->url}}">
                    @endif
                    <div class="price_info">

                        <div class="price_info_old">
                            {{arabic_w2e( number_format($value->price1))}} تومان

                        </div>

                        <div class="price_info_new">
                            @php
                                $price3=$value->price1-$value->price2;
                            @endphp
                            {{ arabic_w2e( number_format($price3))}} تومان 


                        </div>
                        <div class="clock" id="amazing_clock_{{ $key }}"></div>
                        <p>زمان باقی مانده برای این سفارش</p>

                    </div>
                    
                </div>
            </a>
            @endforeach
            


        </div>

        <div id="slider2_navigator">
            <ul class="pr-0">
                    @foreach($amazing as $key=>$value)
                    <li>
                            <a class="underline-from-center">
                                    {{ $value->m_title }}
                            </a>
                    </li>
                    @endforeach
         
            </ul>

        </div>
    </div>
</div>