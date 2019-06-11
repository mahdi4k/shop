<?php $c_id=0; $check=null;

?>
<?php
function arabic_w2e($str)
{
    $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    return str_replace($arabic_western, $arabic_eastern, $str);
}
?>
@if(sizeof($colors)>0)
    <p style="padding-top: 20px;">انتخاب رنگ</p>

    @foreach($colors as $key=>$value)

        @if($service)

            @if($value->id==$service->color_id)
                <?php $c_id=$service->color_id; ?>
            @endif
            <div class="color_box" onclick="set_color('<?= $value->id ?>')">
                <label style="background:#{{ $value->color_code }}"> @if($value->id==$service->color_id) <span class="tick"></span> @endif</label>
                <span>{{ $value->color_name }}</span>
            </div>
        @else
            @if($value->id==$color_id)
                <?php $c_id=$value->id; ?>
            @endif
            <div class="color_box" onclick="set_color('<?= $value->id ?>')">
                <label style="background:#{{ $value->color_code }}"> @if($value->id==$color_id) <span class="tick"></span> @endif</label>
                <span>{{ $value->color_name }}</span>
            </div>

        @endif

    @endforeach
@endif

<input type="hidden" name="color_id" id="color_id" value="{{ $c_id }}">

<div style="width:100%;float: right;">
    @if(sizeof($product->get_service_name)>0)

        <p style="padding-top:55px;font-size:17pt">انتخاب گارانتی</p>
        <?php

        $c=0;
        ?>
        @foreach($product->get_service_name as $key=>$value)

            @if($service)
                @if($value->id==$service->parent_id)

                    <div class="service_title" onclick="show_service()">
                        <span>{{ $value->service_name }}</span>
                        <a class="service_ic" id="service_ic"></a>
                    </div>
                    <input type="hidden" name="service_id" value="{{ $value->id }}" id="service_id">

                @endif
            @else
                @if($color_id==0)


                    @if($service_id==$value->id)
                        <div class="service_title" onclick="show_service()">
                            <span>{{ $value->service_name }}</span>
                            <a class="service_ic" id="service_ic"></a>
                        </div>
                        <input type="hidden" name="service_id" value="{{ $value->id }}" id="service_id">

                    @endif
                @else

                    <?php

                    if($c==0)
                    {
                    $check=DB::table('service')->where(['parent_id'=>$value->id,'color_id'=>$color_id])->orderBy('id','DESC')->first();
                    if($check)
                    {
                    $c=1;
                    ?>
                    <div class="service_title" onclick="show_service()">
                        <span>{{ $value->service_name }}</span>
                        <a class="service_ic" id="service_ic"></a>
                    </div>
                    <input type="hidden" name="service_id" value="{{ $value->id }}" id="service_id">

                    <?php
                    }
                    }
                    ?>


                @endif
            @endif


        @endforeach

        <div class="service_box" id="service_box">
            @foreach($product->get_service_name as $key=>$value)
                <div onclick="set_service('<?= $value->id ?>')">
                    {{ $value->service_name }}
                </div>
            @endforeach
        </div>

    @else

        <input type="hidden" name="service_id" value="0" id="service_id">


    @endif


</div>



<div style="width:100%;float:right;margin-top: 15px;">

    <?php

    if($service)
    {
        $price=$service->price;
    }
    else
    {
        $price=$check ? $check->price :  $product->price;
    }

    ?>
    <div class="product-price" style="width:100%;float:right;margin-top: 15px;">
        @if(!empty($product->discounts))
            <p style="font-size:18pt"><span class="product-peice-title"> {{ arabic_w2e( number_format($product->price)) }}
                    تومان</span></p>
        @endif

        @if(!empty($product->discounts))
            <p><span style="font-size:18pt">قیمت  : </span> <span
                    style="color: #FB3449;font-size: 2.214rem;">{{arabic_w2e( number_format($product->price-$product->discounts)) }}</span>
                تومان</p>
        @endif
        @if(empty($product->discounts))
            <p><span style="font-size:18pt">قیمت  : </span> <span
                    style="color: #FB3449;font-size: 2.214rem;">{{arabic_w2e( number_format($product->price-$product->discounts)) }}</span>
                تومان</p>
        @endif
            <div class="btn-fixed">
        <button type="submit" class="btn btn-info-custom hvr-sweep-to-left">افزودن به سبد خرید
        </button>
            </div>
        <div class="truck">
            <i class="truck-custom fa fa-truck"></i>
            <span>ارسال از دو روز کاری آینده</span>
        </div>
        <div class="property-item">
            <h6 class="">ویژگی های محصول</h6>
            <?php
            $i=1;
            ?>
            @foreach($items as $key=>$value)
                <?php
                $get_child_item = $value->get_child_item;
                ?>
                @foreach($get_child_item as $key2=>$value2)
                    <ul>
                        <li class="d-inline-custom">

                            <span> {{ $value2->name }} :</span>


                            @if(array_key_exists($value2->id,$item_value))
                                <span>  {{ $item_value[$value2->id] }}</span>
                            @endif

                        </li>
                    </ul>
                @endforeach
                @if($i++ == 3)
                    @break
                @endif

            @endforeach
        </div>

    </div>
</div>
