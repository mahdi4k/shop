<section>

    <div class="container-fluid indicator ">
        <div class="title order-title  ">
            <h2 class="text-center">محصولات شاخص</h2>
        </div>
        <div class="row">

            <div class="col-md-6">
                @foreach ($mobile_products as $item)
                @if ($loop->first)
                <figure>
                    <a href="{{ url('product').'/'.$item->code_url.'/'.$item->title_url }}">
                        <img style="width:100%;max-width:450px" class="img-fluid rounded mx-auto d-block"
                            src="{{ url('upload').'/'.$item->get_img->url }}">
                </figure>
                </a>
                <p class="indicator-fa">{{$item->title}}</p>
                <p class="indicator-en">{{$item->code}}</p>
                @endif
                @endforeach
                <div class="items-product-index d-flex">
                    <div class="col-md-7 col-md-offset-2 p-0">
                        @foreach($items as $key=>$value)
                        <?php
                                $get_child_item = $value->get_child_item;
                                ?>
                        @foreach($get_child_item as $key2=>$value2)
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item indicator-li pl-0 text-center mr-5">
                                <span> {{ $value2->name }} :</span>
                            </li>
                        </ul>
                        @endforeach


                        @endforeach
                    </div>
                    <div class="col-md-1 pr-0">





                        <ul class="list-group list-group-flush text-right">
                            @foreach ($item_value as $item)
                            @if($item->value==1 )
                            <li style="color:skyblue; padding:13px" class="list-group-item pr-0 fa fa-check"></li>
                            @endif
                            @endforeach
                        </ul>


                    </div>

                </div>
                @foreach ($mobile_products as $item)
                @if ($loop->first)
                <a href="{{ url('product').'/'.$item->code_url.'/'.$item->title_url }}" style="color:white"
                    class="btn btn-info-custom hvr-sweep-to-left btn-index"> افزودن به سبد خرید<i
                        class="fa fa-shopping-cart mr-2"></i> </a>
                @endif
                @endforeach

            </div>

            <div class="col-md-6">
                @foreach ($mobile_products as $item)
                @if ($loop->last)
                <a href="{{ url('product').'/'.$item->code_url.'/'.$item->title_url }}">
                    <figure>
                        <img style="height:249px;width:100%;max-width:450px" class="  rounded mx-auto d-block"
                            src="{{ url('upload').'/'.$item->get_img->url }}">
                    </figure>
                </a>
                <p class="indicator-fa">{{$item->title}}</p>
                <p class="indicator-en">{{$item->code}}</p>



                @endif
                @endforeach
                <div class="items-product-index d-flex">
                    <div class="col-md-7 col-md-offset-2 p-0">
                        @foreach($items as $key=>$value)
                        <?php
                            $get_child_item = $value->get_child_item;
                            ?>
                        @foreach($get_child_item as $key2=>$value2)
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item indicator-li pl-0 text-center mr-5">
                                <span> {{ $value2->name }} :</span>
                            </li>

                        </ul>
                        @endforeach


                        @endforeach
                    </div>
                    <div class="col-md-1 pr-0">





                        <ul class="list-group list-group-flush text-right">
                            @foreach ($item_value as $item)
                            @if($item->value==1)
                            <li style="color:skyblue; padding:13px" class="list-group-item pr-0 fa fa-check"></li>
                            @endif
                            @endforeach
                        </ul>


                    </div>
                </div>
                @foreach ($mobile_products as $item)
                @if ($loop->first)
                <a href="{{ url('product').'/'.$item->code_url.'/'.$item->title_url }}" style="color:white"
                    class="btn btn-info-custom hvr-sweep-to-left btn-index"> افزودن به سبد خرید<i
                        class="fa fa-shopping-cart mr-2"></i> </a>
                @endif
                @endforeach
            </div>

        </div>
    </div>
</section>