
<div style="padding-top: 10px;">

    <?php

$cart_date=\App\Cart::get();

function arabic_w2e($str)
                {
                    $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
                    $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
                    return str_replace($arabic_western, $arabic_eastern, $str);
                }
?>
@if(sizeof($cart_date)==0)

    <p style="color:red;text-align:center;padding-top:30px;padding-bottom: 20px;">سبد خرید شما خالی می باشد</p>

@else

    <?php
    $total_price=0;
    $price=0;
    ?>

    @foreach($cart_date as $key=>$value)

        <?php

        $product_data=array_key_exists('product_data',$value) ? $value['product_data'] : array();
        $j=1;
        ?>

        @foreach($product_data as $key2=>$value2)
            <?php
            $s_c=explode('_',$key2);
            $service_id=$s_c[0];
            $color_id=$s_c[1];
            $data=\App\Cart::get_date($key,$service_id,$color_id);
            ?>
            @if($data)

                <div class="cart_box">

                    <div class="col-xs-5">
                        <img class="cart_img" src="{{ $data['img'] }}">
                    </div>
                    <div class="col-xs-7">
                        <p onclick="del_product('{{ $key }}','{{ $s_c[0] }}','{{ $s_c[1] }}')" ><span class="fa fa-trash"></span></p>
                        <p><a href="{{ url('product').'/'.$data['code_url'].'/'.$data['title_url'] }}">{{ $data['code'] }}</a></p>
                        <p><a style="color: #818181;" href="{{ url('product').'/'.$data['code_url'].'/'.$data['title_url'] }}">{{ $data['title'] }}</a></p>
                        @if(!empty($data['service_name']))
                            <p style="color:#777"><span>گارانتی : </span> {{ $data['service_name'] }}</p>
                        @endif
                        @if(!empty($data['color_name']))
                            <p style="color:#777">
                                <span>رنگ : </span>
                                <label style="background:#{{ $data['color_code'] }}" class="color_product"></label>
                                <span>{{ $data['color_name'] }}</span>
                            </p>
                        @endif


                        <p>
                            <span style="padding-top:5px;">تعداد : </span>
                            <label class="number_cart_product">
                                <span onclick="change_number_cart_product('{{ $value2+1 }}','{{ $key }}','{{ $color_id }}','{{ $service_id }}')">+</span>
                                <span style="background:white">{{ $value2 }}</span>
                                <span onclick="change_number_cart_product('{{ $value2-1 }}','{{ $key }}','{{ $color_id }}','{{ $service_id }}')">-</span>
                            </label>
                        </p>
                    </div>


                    <?php $j++; ?>

                    <table class="table table-bordered">
                        <tr>
                            <td>قیمت واحد</td>
                            <td>{{arabic_w2e ( number_format($data['price2'])) }} تومان</td>
                        </tr>
                        <tr style="color:#4CAF50">
                            <td>قیمت کل</td>
                            <td>{{arabic_w2e (number_format($data['price2']*$value2)) }} تومان </td>
                        </tr>
                    </table>

                    <div style="clear:both"></div>
                </div>

                <?php
                $total_price+=$data['price1']*$value2;
                $price+=$data['price2']*$value2;
                ?>
            @endif

        @endforeach

    @endforeach

    <div class="w-100 pr-2 pl-2">
        <div class="cart_price2">
            <div>
                <?php

                Session::put('total_price', $total_price);
                Session::put('price', $price);

                ?>
                <ul class="list-inline">
                    <li style="margin-right:15px; display: inline">جمع کل خرید شما :</li>
                    <li style="float:left;margin-left:10px"><span
                            class="p1">{{ arabic_w2e( number_format($total_price)) }}</span>
                        تومان
                    </li>
                </ul>
            </div>
            <div style="background:#F7FFF7;">
                <ul class="list-inline">
                    <li class="list-inline-item" style="margin-right:15px;color:#4CAF50;display: inline">مبلغ قابل
                        پرداخت :
                    </li>
                    <li class="list-inline-item" style="color:#4CAF50;margin-left:10px"><span
                            class="p1">{{ arabic_w2e( number_format($price)) }}</span> تومان
                    </li>
                </ul>
            </div>
        </div>


    </div>
 @endif

</div>