<div class="search_body">



    <div style="width:97%;margin:auto;">


        <?php
function arabic_w2e($str)
    {
        $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return str_replace($arabic_western, $arabic_eastern, $str);
    }

        function get_score($data)
        {
            $s=0;
            foreach ($data as $k=>$v)
            {

                    $a=explode('@#',$v->value);
                    foreach ($a as $key=>$value)
                    {
                        if(!empty($value))
                        {
                            $b=explode('_',$value);
                            if(is_array($b))
                            {
                                if(sizeof($b)==2)
                                {
                                    $s+=$b[1];
                                }
                            }

                        }
                    }
            }
            if($s>0)
            {
                $n=sizeof($data)*5;
                $s=$s/$n;
                $s=substr($s,0,3);
            }
            return $s;
        }

        ?>

        <div style="width:100%;float:right;">

            {!!  str_replace('ajax/set_filter_product',$cat_url,$product->links()) !!}
        </div>


            @foreach($product as $key=>$value)

                <div class="search_product_box">
                        <a href="{{ url('product').'/'.$value->code_url.'/'.$value->title_url }}">
                    <img  src="{{ url('upload').'/'.$value->get_img->url }}">
                        </a>

                    <?php

                    $score=get_score($value->get_score);
                    ?>

                    
                     
                    <p class="title text-center">
                        <a href="{{ url('product').'/'.$value->code_url.'/'.$value->title_url }}">
                            @if(strlen($value->title)>35)
                                {{ mb_substr($value->title,0,28).' ... ' }}
                            @else
                                {{ $value->title }}
                            @endif
                        </a>
                    </p>

                    <p style="color:red; text-align:center">
                        @if($value->product_status==1)
                            @if(!empty($value->price))
                                {{ arabic_w2e(number_format($value->price)) }} تومان
                            @else
                                <span>نا موجود</span>
                            @endif
                        @else
                            <span>نا موجود</span>
                        @endif
                    </p>
                    <a href="{{ url('product').'/'.$value->code_url.'/'.$value->title_url }}">
                    <div class="amazing-button mb-5 text-center  ">
                            <button class="btn btn-info">افزودن به سبد خرید</button>
                     </div>
                    </a>
                </div>

            @endforeach

            @if(sizeof($product)==0)

                <div style="clear:both;padding-top: 30px;"></div>
                <div style="background-color: #F7F8FA;border: 1px dashed #C7C7C7;text-align:center;width:97%;margin:auto;padding-top:14px;padding-bottom:8px">
                    <p>محصولی برای نمایش یافت نشد</p>
                </div>

            @endif

            <div style="clear:both;padding-top: 30px;"></div>


    </div>

</div>

<script>
    <?php
    $url=url('Search').'?text='.$Search_text;
    ?>
    $('.pagination a').click(function (event) {
        event.preventDefault();
        var url=$(this).attr('href');
        var url=url.split('page=');
        if(url.length==2)
        {
            var ajax_url='<?= $url ?>&page='+url[1];
            send_data(ajax_url);
        }
    });
</script>